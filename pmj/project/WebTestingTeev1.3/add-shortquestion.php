<?php
include "check-user.php";
//ต้องเป็นผู้ทดสอบเท่านั้นที่จะเปิดเพจนี้ได้(ป้องกันการเปิดเพจนี้โดยตรงของผู้เข้าทดสอบ)
if($_SESSION['user'] != "tester") {   
	die("<h2>For Tester Only</h2>");
}
else if(!$_GET['subject_id']) {
	die("<h2>Require Subject ID</h2>");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add short question</title>
<style>
	@import "global2.css";
	form {
		width: 700px;
		border: solid 0px green;
		border-radius: 8px;
 		margin: 10px auto 15px;
		padding: 10px 0px;
		background: #cee;
	}
	form input:not([type=radio]) {
		background: #ffd;
		border: solid 1px gray;
		padding: 2px;
		color: blue;
	}
	form [type=file] {
		background: inherit !important;	
		border:none !important;
	}
	form label {
		display: inline-block;
		width: 180px;
		text-align: right;
		padding: 5px;
	}
	form div {
		text-align: center;
		margin-top: 10px;
	}
	form button {
		background: steelblue;
		color: white;
		border: solid 1px orange;
		padding: 3px;
		width: 80px;
		margin-right: 50px;
	}
	form button:hover {
		color: aqua;
		cursor: pointer;
	}
	form input[name=question] {
		width: 450px;	
	}
	form input[type=file] {
		width: 300px;	
	}
	form input[name^=choice] {
		width: 300px;	
		margin: 2px 0px;
	}
	section#content h4 {
		text-align: center;
		color: green;
	}
	section#content h4.err {
		color: red;
	}
	section#content h4 img {
		margin-right: 3px;
		vertical-align: middle;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	$('#ok').click(function(event) { 
		var error = false;
		$(':text').each(function() {
			if($(this).val().length == 0) {
				alert('Information required');
				error  = true;
				return false;
			}
        });
		
		if(error) {
			return;
		}
		
		

		$('form').submit();
	});
	
	$('#cancel').click(function() {
		window.location = 'index.php';
	});
});
</script>
</head>

<body>
<?php
include "dblink.php";
$subject_id = $_GET['subject_id'];	

$msg = "";
$img = "no.png";
if($_POST) {
	$subject_id = $_POST['subject_id'];
	$q = $_POST['question'];
	$f = "";
	$t = "";
	$msg = "";

	$answer1 = $_POST['answer1'];
	//ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
	//เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป (รายละเอียดอยู่ในบทที่ 14)
	if(is_uploaded_file($_FILES['file']['tmp_name']))  {
		$error =  $_FILES['file']['error'];
		if($error == 0) {
			include "lib/IMager/imager.php";
			$img = image_upload('file');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, 500, 200); //ให้ภาพกว้างไม่เกิน 200px สูงไม่เกิน 200px
			$f = image_store_db($img, "image/jpeg");
		}
		else if($error == 1 || $error == 2 ) {
			$msg = "File was to big";
		}
		else if($error == 4) {
			$msg = "Error occur";
		}
	}
	
	if($msg=="") {
		//เพิ่มคำถามลงในตาราง question ก่อน
		$sql = "REPLACE INTO question VALUES('', '$subject_id', '$q', '$f', '$answer1')";
	
		if(@mysqli_query($link, $sql)) {
			//อ่านค่า id ของคำถามที่เพิ่มใหม่ เพื่อนำไปเชื่อมโยงกับตัวเลือกในตาราง choice
			$question_id = mysqli_insert_id($link);   
			
			//ตัวเลือกถูกส่งขึ้นมาในรูปแบบอาร์เรย์ เราจะใส่ลงในตาราง choice ทีละตัวเลือก
			//for($i = 1; $i <= count($_POST['answer']); $i++) {
			//	$ch_text = $_POST['answer'][$i];
			//	$answer = "no";
			//	if($_POST['answer'] == $i) {	//ถ้าตัวเลือกนั้นถูกกำหนดให้เป็นคำตอบ(ดูเลขลำดับอาร์เรย์ในฟอร์มประกอบ)
			//		$answer =  "yes";
			//	}
			//	$sql = "REPLACE INTO choice VALUES('', '$question_id', '$ch_text', '$answer1')";
			//	mysqli_query($link, $sql);
			
			//$msg = 'Question Added<br>Add more question or head back to  <a href="index.php">Main menu</a>';
			//$img = "ok.png";
			
				}		}
		else {
			$msg = "Error occur, Please try again";
		}
		
	
}
?>
<div class="nav">
	<?php include "header.php"; ?>
	</div>
<div id="container">

<article>
<section id="top">
<?php
$sql = "SELECT subject_text FROM subject 	WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
?>
	<h3>Add short Question</h3>
    <span>Subject: <?php echo $row[0]; ?></span>
</section>

<section id="content">
<?php
//ถ้ากำหนดวันเวลาในการทำแบบทดสอบหัวข้อนี้เอาไว้ และขณะนั้นเลยวันเวลาที่กำหนดแล้ว
//จะไม่อนุญาตให้เพิ่มคำถามให้กับแบบทดสอบหัวข้อนี้ได้อีก
$sql = "SELECT CONCAT(date_test, ' ', time_start) FROM subject WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$dt_test = strtotime($row[0]);
$now = strtotime("now");


if(($row[0] != "0000-00-00 00:00:00") && ($now >= $dt_test)) {
	echo '<h4 class="err">
	Not available to do right now<br>
	Due to out of available range times.
			</h4>
			</section></article>';
	include "footer.php";
	echo '</div></body></html>';
	exit;
}
@mysqli_close($link);
?>
<?php echo $msg;  ?>
<form method="post" enctype="multipart/form-data">
	<label>Question:</label><input type="text" name="question"><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <label>Picture (optional):</label><input type="file" name="file"><br>
    <label></label>* File size must be under 1 MB<br><br>
    <label>Answer:</label><input type="text" name="answer1" maxlength="50">
    <div>
     	<button type="button" id="ok">Submit</button>
         <a href="index.php">Cancel</a>
	</div>
    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
    
</form>
</section>

</article>
</div>
</body>
</html>