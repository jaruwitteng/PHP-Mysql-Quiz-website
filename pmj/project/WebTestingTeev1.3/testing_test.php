<?php  
include "check-user.php";

if(!$_GET['subject_id']) {
	die("<h2>Require Subject ID</h2>");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing</title>
<style>
	@import "global2.css";
	article {
		text-align:center;
		padding-bottom: 10px;
	}
	section#top span#title {
		display: inline-block;
		width: 680px;
	}
	section#top span#date-test {
		display:inline-block;
		width: 200px;
		font-size: smaller;
		color: navy;
		text-align: right;
	}
	section#top {
		margin-bottom: 10px;
		text-align: left !important;
	}
	div#table-container table {
		margin: auto;
		border-collapse: collapse;
	}
	td {
		
		vertical-align: top;
		border-radius: 5px;
		padding: 10px 0px 30px 0px;
		text-align: left !important;
	}
	td#content {
		width: 720px;
		background: #def;
	}	
	td#aside {
		
		position: absolute;
		top: 20vw;
      	right: 0vw;
		width: 150px;
		background: antiquewhite;
		border-left: solid 3px white;
	}
	td#content div {
		display: inline-table;
		margin: 2px 1px;
	}
	div.number {
		width: 50px;
		text-align: right !important;
		font: bold 16px tahoma;
		color: brown;
	}
	div.question {
		
		width: 650px;
		text-align: left !important;
		font: bold 16px tahoma;
		color: green;
		padding-left: 3px;
	}
	div.radio {
		width: 80px;
		text-align: right !important;
	}
	div.choice {
		width: 620px;
		text-align: left !important;
	}
	div.question p {
		margin: 5px;
	}
	hr.separator {
		width: 95%;
	}
	td#aside > div#fin {
		text-align: center;
	}
	td#aside > div#fin > button {
		margin-bottom: 5px;
		background: #F30;
		border: solid 1px gray;
		padding: 3px 5px;
		color: yellow;
		font-weight: bold;
		border-radius: 5px;
	}
	td#aside > div#fin > button:hover {
		background: aqua;
		color: red;
		cursor: pointer;
		box-shadow: 4px 4px 5px darkblue;
		transition: all 1s ease;
	}
	td#aside > div#fin > #next:hover {
		background: red;
		color: red;
		cursor: pointer;
		transition: all 1s ease;
	}
	td#aside > div#fin > #next {
		text-decoration: none;
	}
	
	td#aside > div#fin > span {
		display:block;	
	}
	td#aside > ul {
		padding-left: 30px;
	}
	td#aside ul  a {
		text-decoration: none;
		padding: 5px 0px;
	}
	td#aside ul  a:hover {
		color: red;
	}
	h3.red {
		color: red;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {	
	$(':radio').change(function(event) {
		var subject_id = <?php echo $_GET['subject_id']; ?>;
		var question_id = event.target.name;
		var choice_id = event.target.value;
		
		$.ajax({
			url: 'select-choice.php',
			type: 'post',
			data: {'subject_id':subject_id, 'question_id':question_id, 'choice_id':choice_id},
			dataType: 'script',
			beforeSend: function() {
				$('body').css({cursor: 'wait'});
			}, 
			complete: function() {
				$('body').css({cursor: 'default'});
			}
		});
	});
	
	$('#bt-fin').click(function() {
		if(confirm('Confirm to finish the test?')) {
			var subject_id = <?php echo $_GET['subject_id']; ?>;
			window.location = 'finish.php?subject_id=' + subject_id;
		}
	});
});
</script>
</head>

<body>
<div class="nav">
	<?php include "header.php";?>
</div>
<div id="container">
<?php
//time error
ob_start();
include "dblink.php";

//อ่านค่าวันเวลาที่กำหนดในการทำแบบทดสอบเพื่อนำไปแสดงที่ section#top
$subject_id = $_GET['subject_id'];

$sql = "SELECT subject_text,
 				DATE_FORMAT(date_test, '%d/%m/%Y'), 
				TIME_FORMAT(time_start, '%H:%i'),  
				TIME_FORMAT(time_end, '%H:%i'),
				date_test, time_start, time_end
 			FROM subject WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
if ($row){
$subject = $row[0];
$datetime = $row[1] . "   " . $row[2]. "-" . $row[3];
if($row[1] == "00/00/0000") {
	$datetime = "No due";
	}
}
?>
<article>

<section id="top">
	<h3>Test</h3>
    <span id="title"><b>Subject:</b> <?php echo $subject; ?></span>
    <span id="date-test"><?php echo "[$datetime]";  ?></span>
</section>

<?php
$now = strtotime("now");
$start = $row[4] . " " . $row[5];
$end = $row[4] . " " . $row[6];
$start = strtotime($start);
$end = strtotime($end);
//ถ้าเป็นผู้ทำแบบทดสอบ และกำหนดวันเวลาที่แน่นอนในการทำแบบทดสอบ
//แล้วถ้าไม่อยู่ในช่วงวันเวลาที่กำหนดในการทำแบบทดสอบ จะไม่แสดงคำถาม
if(($_SESSION['user'] == "testee") && ($row[1] != "00/00/0000") && (($start > $now) || ($end < $now))) {
	echo '<h3 class="red">ขณะนี้ไม่อยู่ในช่วงวันเวลาที่กำหนดในการทำแบบทดสอบ</h3>
			<h4>หากท่านทำแบบทดสอบหัวข้อนี้ไปแล้ว แต่ยังไม่ได้ยืนยันการเสร็จสิ้นการทำแบบทดสอบ<br>
					 ให้คลิกลิงก์ต่อไปนี้เพื่อยืนยัน มิฉะนั้นการทำแบบทดสอบในหัวข้อนี้ของท่านจะเป็นโมฆะ<br><br>
					 <a href="finish.php?subject_id='.$_GET['subject_id'].'">เสร็จสิ้นการทดสอบ</a>
			</h4>
			</article>';
			
	include "footer.php";
	echo '</div></body></html>';
	exit;
}
//ถ้าเป็นผู้ทำแบบทดสอบ และเคยทำแบบทดสอบหัวข้อนี้ไปแล้ว ก็จะไม่อนุญาตให้ทำซ้ำอีก
if(isset($_SESSION['testee_id'])) {
	$testee_id = $_SESSION['testee_id'];
	$sql = "SELECT COUNT(*) FROM score WHERE subject_id = $subject_id AND testee_id = $testee_id";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
	if($row[0] !=0) {
		mysqli_close($link);
		echo "<h4>You already done this subject</h4>
				</article>";
		include "footer.php";
		echo "</div></body></html>";
		exit;
	}
}
//ตรวจสอบว่ามีคำถามของหัวข้อนี้หรือไม่
$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) == 0) {
	mysqli_close($link);
	echo "<h4>No questions</h4>
			</article>";
	include "footer.php";
	echo "</div></body></html>";
	exit;
}
?>
<div id="table-container">
<table>
<tr><td id="content">

<?php

$sql = "SELECT * FROM question WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
$questions = array();
$num_q = 0;

if (!isset($_SESSION["pass"])){
	$_SESSION["pass"] = array();
}

// if subject_id change then reassign session's ["questions"] etc.
if (isset($_SESSION["subject_id"]))
{
	if ($_SESSION["subject_id"] != $subject_id)
	{
		$_SESSION["questions"] = NULL;
		$_SESSION["choices"] = NULL;
	}
}
$_SESSION["subject_id"] = $subject_id;

// questions array store inside a session ["questions"]
while($data = mysqli_fetch_array($result)) {
	$questions[] = $data;
	$num_q++;
}
shuffle($questions);

if (!isset($_SESSION["questions"])){
	$_SESSION["questions"] = $questions;
}
//print_r ($questions);


if (isset($_GET["question"])){
	if (intval($_GET["question"]) > 0){
		
		$data = $_SESSION["questions"][intval($_GET["question"])- 1];
		$question_text = $data['question_text'];
		$question_id = $data['question_id'];
		$sql = "SELECT * FROM choice WHERE question_id = $question_id ORDER BY choice_id ASC";
		$r = mysqli_query($link, $sql);
		$choices = array();
		
		echo '
				<div class="question">'.$question_text;
		
		if($data['image']!=null) {		//ถ้ามีรูปภาพประกอบ 
			echo '<p><img src="read-img.php?question_id='.$question_id.'"></p>';
		}
		echo '</div><br>';	
		
		while($ch = mysqli_fetch_array($r)) {
			$choices[] = $ch;
		}
		shuffle($choices);
		$_SESSION["choices"] = $choices;
		
		//แสดง radio และตัวเลือกของคำถามนั้นๆ
		$short = $data['short'];
			
			
			//if ($short == !null) {
			if ($short == !null) {
				echo '<label>Answer:</label><input type="text" name="answer1" maxlength="50">';
				
			}
			foreach ($_SESSION["choices"] as $ch) {
				//ถ้าเป็นผู้ทำแบบทดสอบ จะตรวจสอบว่าเคยเลือกตัวเลือกของคำถามข้อนั้นไว้ก่อนหรือไม่
				$checked = "";
				if(isset($_SESSION['testee_id'])) {
					$testee_id = $_SESSION['testee_id'];
					
					$sql = "SELECT choice_id FROM testing WHERE testee_id = $testee_id AND question_id = $question_id";  //AND subject_id = $subject_id 
					$choose = mysqli_query($link, $sql);
					$row = mysqli_fetch_array($choose);
					if ($row){
						$id = $row[0];
						if($id == $ch['choice_id']) { //ถ้าเคยเลือกตัวเลือกนั้น ให้เติมแอตทริบิวต์ checked ไว้ในแท็กของ radio
							$checked = "checked";
						}
					}
				}
				
				else {
					if (!in_array($_GET["question"], $_SESSION["pass"]))
					{
					echo "<div class=\"radio\"><input type=\"radio\"  name=\"$question_id\" value=\"{$ch['choice_id']}\"$checked></div>
						<div class=\"choice\">{$ch['choice_text']}</div><br>";
					}
					else {
					echo "<div class=\"radio\"><input type=\"radio\" disabled name=\"$question_id\" value=\"{$ch['choice_id']}\"$checked></div>
						<div class=\"choice\">{$ch['choice_text']}</div><br>";
					}
				}
				
				
		
				
				
			}
		$step = intval($_GET["question"]);
		if ($num_q == $step)
		{
			
		}
		else
		{
			$_SESSION["pass"][] = $step;
			$step++	;
		}
		
		$query = $_GET;
		// replace parameter(s)
		$query['question'] = $step;
		// rebuild url
		$query_result = http_build_query($query);
		header( "refresh:5;url=testing.php?subject_id=$subject_id&question=$step;" );
		
	}
}
else{
	$step = 1;
	
	$query = $_GET;
	// replace parameter(s)
	$query['question'] = $step;
	// rebuild url
	$query_result = http_build_query($query);
	
	// new link
}
?>


</td>
<td id="aside">
<div id="fin">
	<button type="button" id="bt-fin">Finish test</button>
	<?php
	if (isset($_GET["question"]))
	{
		echo "Question#".($_GET["question"])." Total#".$num_q;
	
		if ($num_q == ($_GET["question"]))
		{
			?>
			<p>&nbsp;</p>
			<h>All Question passed</h>
			<?php
		}
	}
	else {
		echo "Question#0 Total#".$num_q;
	}

		?>
		<p>&nbsp;</p>
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>">NEXT</a>
		
	
<?php 
?>
	<a href=""></a>
</div>
<?php

mysqli_close($link);
?>
</td>
</tr>
</table>
</div>
</article>

</div>
</body>
</html>