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
	section#content {
		padding: 10px 0px;
		width: 720px;
		display: inline-table;
		background: #dee;
		padding-top: 10px;
		text-align: left;
		border-radius: 8px;
	}	
	aside {
		display: inline-table;
		width: 150px;
		background: mistyrose;
		text-align: left !important;
		padding-top: 10px;
		border-radius: 8px;
	}
	section#content div {
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
	aside > div#fin {
		text-align: center;
	}
	aside > div#fin > button {
		margin-bottom: 5px;
		background: coral;
		border: solid 1px gray;
		padding: 3px 5px;
		color: yellow;
		font-weight: bold;
		border-radius: 5px;
	}
	aside > div#fin > button:hover {
		background: aqua;
		color: red;
		cursor: pointer;
	}
	aside > div#fin > span {
		display:block;	
	}
	aside > ul {
		padding-left: 30px;
	}
	aside ul  a {
		text-decoration: none;
		padding: 5px 0px;
	}
	aside ul  a:hover {
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
		if(confirm('ยืนยันการเสร็จสิ้นการทำแบบทดสอบ?')) {
			var subject_id = <?php echo $_GET['subject_id']; ?>;
			window.location = 'finish.php?subject_id=' + subject_id;
		}
	});
	
	setTimeout(function() {
		var h = $('section#content').height() + 'px';
		$('aside').height(h);
	}, 500);

});
</script>
</head>

<body>
<div id="container">
<?php 
include "header.php"; 
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
$subject = $row[0];
$datetime = $row[1] . "   " . $row[2]. "-" . $row[3];
if($row[1] == "00/00/0000") {
	$datetime = "ไม่กำหนดวันเวลา";
}
?>
<article>

<section id="top">
	<h3>แบบทดสอบ</h3>
    <span id="title"><b>หัวข้อ:</b> <?php echo $subject; ?></span>
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
		echo "<h4>ท่านได้ทำแบบสอบทดสอบหัวข้อนี้ไปแล้ว ไม่สามารถทำซ้ำได้อีก</h4>
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
	echo "<h4>ยังไม่มีคำถามสำหรับแบบทดสอบหัวข้อนี้</h4>
			</article>";
	include "footer.php";
	echo "</div></body></html>";
	exit;
}
?>

<section id="content">
<?php
$begin = 1;   //แถวเริ่มต้นในการอ่านข้อมูล
if($_GET['begin']) {
	$begin = $_GET['begin'];
}
$length = 5;	//จำนวนคำถามในการอ่านข้อมูลแต่ละช่วง
if($_GET['length']) {
	$length = $_GET['length'];
}

$begin--;   //ลำดับแถวใน MySQL เริ่มจาก 0
$sql = "SELECT * FROM question WHERE subject_id = $subject_id LIMIT $begin, $length";
$result = mysqli_query($link, $sql);
$num = $begin + 1;
$first_row = true;
while($data = mysqli_fetch_array($result)) {
	if(!$first_row) {
		echo '<hr class="separator">';
	}
	//แสดงลำดับข้อ, คำถาม และรูปภาพ(ถ้ามี)
	$question_text = $data['question_text'];
	$question_id = $data['question_id'];
	$sql = "SELECT * FROM choice WHERE question_id = $question_id ORDER BY choice_id ASC";
	$r = mysqli_query($link, $sql);
	echo '<div class="number">'.$num.'.</div>
	 		<div class="question">'.$question_text;
 	
	if($data['image']!=null) {		//ถ้ามีรูปภาพประกอบ 
		echo '<p><img src="read-img.php?question_id='.$question_id.'"></p>';
	}
	echo '</div><br>';	
	
	//แสดง radio และตัวเลือกของคำถามนั้นๆ
	while($ch = mysqli_fetch_array($r)) {
		//ถ้าเป็นผู้ทำแบบทดสอบ จะตรวจสอบว่าเคยเลือกตัวเลือกของคำถามข้อนั้นไว้ก่อนหรือไม่
		$checked = "";
		if(isset($_SESSION['testee_id'])) {
			$testee_id = $_SESSION['testee_id'];
			$sql = "SELECT choice_id FROM testing WHERE testee_id = $testee_id AND question_id = $question_id";  //AND subject_id = $subject_id 
			$choose = mysqli_query($link, $sql);
			$row = mysqli_fetch_array($choose);
			$id = $row[0];
			if($id == $ch['choice_id']) { //ถ้าเคยเลือกตัวเลือกนั้น ให้เติมแอตทริบิวต์ checked ไว้ในแท็กของ radio
				$checked = " checked";
			}
		}
		echo "<div class=\"radio\"><input type=\"radio\"  name=\"$question_id\" value=\"{$ch['choice_id']}\"$checked></div>
				<div class=\"choice\">{$ch['choice_text']}</div><br>";
	}
	$num++;
	$first_row = false;
}
?>
</section>

<aside>
<div id="fin">
	<button type="button" id="bt-fin">เสร็จสิ้นการทดสอบ</button>
	<span>คำถามลำดับที่:</span>
</div>
<?php
//นับจำนวนคำถามว่ามีกี่ข้อ
$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$num_question = $row[0];

//ค่า $length จำนวนข้อในแต่ละช่วง ซึ่งตัวแปรนี้กำหนดค่าไว้ตั้งแต่ขั้นตอนก่อนนี้แล้ว
$group = intval($num_question / $length);  
$remain = $num_question % $length;  //เศษที่ไม่ถึงค่า $length
echo "<ul>";
for($i = 1; $i <= $group; $i++) {
	$begin = (($i - 1) * $length) + 1;  //เช่นถ้า $length = 5 ค่า $begin จะเป็น 1, 6, 11, 16, ...
	$end = $i  * $length;  //เช่นถ้า $length = 5 ค่า $end จะเป็น 5, 10, 15, 20, ...
	question_range($begin, $end);
}
if($remain > 0) {  //กรณีมีเศษที่ไม่ถึงค่า $length
	$begin = $num_question-$remain+1;
	$end = $num_question;
	question_range($begin, $end);
}
echo "</ul>";
function question_range($begin, $end) {
	global $subject_id, $length;
	$url = $_SERVER['PHP_SELF'];
	echo "<li><a href=\"$url?subject_id=$subject_id&begin=$begin&length=$length\">$begin - $end</a></li>";
}
mysqli_close($link);
?>
</aside>
</article>
<?php include "footer.php"; ?>
</div>
</body>
</html>