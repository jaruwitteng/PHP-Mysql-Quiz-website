<?php  include "check-user.php"; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Exam Guru</title>
<style>
	@import "./global2.css";
	
	section#content {
		text-align: center;
		padding: 15px 5px;
		box-shadow: 3px 3px 5px darkblue;
		
	}
	section#content > div {
		padding-top: 5px;
	}
	div.subject {
		
		width: 1200px;
		display: inline-table;
		text-align: left;
		font-size: 18px;
		color: green;
	}
	div.question {
		width: 125px;
		display: inline-table;
		text-align: right;
	}
	div.datetime {
		width: 900px;
		display: inline-table;	
		font-size: 14px;
		color: gray;
		text-align: left;
	}
	div.button {
		width: 425px;
		display: inline-table;
		text-align: right;	
	}
	div.button > a {
		width: 100px;
		border: solid 1px brown;
		border-radius: 5px;
		background: khaki;
		padding: 2px 5px;
		margin: 2px;
		text-decoration: none;
		font-size: 13px;
	}
	div.button > a:hover {
		background: aqua;
		color: red;
		box-shadow: 4px 4px 5px rgb(61, 108, 179);
		transition: all 1s ease;
	}
	hr {
		width: 96%;
	}
	section#top a {
		display: inline-block;
		float: right;
		border: solid 1px gray;
		padding: 5px;
		padding-left: 28px !important;
		margin: 7px 5px;
		text-decoration: none;
		background:#cc6 2px center no-repeat;
		border-radius: 5px;
		color: #30c;
	}
	section#top a:hover {
		background-color: aqua;
		color: red;	
		box-shadow: 4px 4px 5px rgb(61, 108, 179);
		transition: all 1s ease;
	}
	div#pagenum {
		text-align: center;
	}
</style>

<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {

});
</script>
</head>

<body>
<div class="nav">
	<?php include "header.php"; ?>
</div>
<div id="container">

<article>

<section id="top">
<?php
//เนื่องจากเราต้องการแสดงปุ่มที่อยู่มุมขวาบนของ section#top นั้น ให้สอดคล้อง
//กับชนิดของผู้ใช้่ระหว่าง tester และ testee ดังนั้นจึงต้องมีการตรวจสอบก่อน
$bg_img = "";
if($_SESSION['user']  == "testee") {  //ถ้าเป็นผู้เข้าทำแบบทดสอบ
	echo '<a href="score.php">See results</a>';
	$bg_img = "ok.png";
}
else if($_SESSION['user'] == "tester") {  //ถ้าเป็นผู้ทดสอบ
	echo '<a href="new-subject.php">Add new test</a>';
	$bg_img = "plus.png";
}
echo "<script> $('section#top a').css('background-image', 'url(images/$bg_img)'); </script>";
?>
    <h3>All subject tests </h3>
   <span>Order ? - ? from ?</span> <!-- จะนำข้อมูลมาเติมทีหลังด้วย jQuery -->
</section>

<section id="content">
<?php
include "dblink.php";
include "lib/pagination.php";
//อ่านหัวข้อแบบทดสอบจากตาราง subject
//ให้รูปแบบวันเดือนปีให้เป็น date-month-year และเวลาเป็น hour:minute
$sql = "SELECT *, 
 				DATE_FORMAT(date_test, '%d-%m-%Y') AS date_test, 
				TIME_FORMAT(time_start, '%H:%i') AS time_start,  
				TIME_FORMAT(time_end, '%H:%i') AS time_end   
			FROM subject ORDER BY  subject_id DESC";

$result = page_query($link, $sql, 10);    //ใช้ฟังก์ชั่นนี้เพราะต้องการแบ่งเพจ(รายละเอียดในบทที่ 12)

while($data = mysqli_fetch_array($result)) {
	$subject_id = $data['subject_id'];
	$dt = "Date " . $data['date_test'] . " Time " . $data['time_start'] . " - " . $data['time_end'];	
	if($data['date_test'] == "00-00-0000") {   //กรณีที่ไม่กำหนดวันเวลาทำแบบทดสอบเอาไว้
		$dt = "None";
	}
	$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";  //นับจำนวนคำถามของหัวข้อนี้
	$r = mysqli_query($link, $sql);
	$num_q = 0;
	if($r) {
		$row = mysqli_fetch_array($r);
		$num_q = $row[0];
	}
	//สร้างปุ่มให้สอดคล้องกับชนิดผู้ใช้ระหว่าง tester และ testee
	$bt = "";
	$q = "subject_id=$subject_id";
	if($_SESSION['user']  == "testee") {
		$bt = '<a href="testing.php?'.$q.'">ทำแบบทดสอบ</a>';
	}
	else if($_SESSION['user'] == "tester") {
		$bt = '<a href="add-shortquestionv2.php?'.$q.'">Add short question</a>'.
		'<a href="add-question.php?'.$q.'">Add question</a>'.
				'<a href="testing.php?'.$q.'">Do test</a>'.
				'<a href="#">Delete/Edit</a>';
	}	
	echo '<div class="subject">'.$data['subject_text'].'</div>
			<div class="question">'.$num_q.' Questions</div><br>
			<div class="datetime">Due: '.$dt.'</div>
			<div class="button">'.$bt.'<a href="score.php?'.$q.'">Results</a></div><hr>';
}
$start = page_start_row();
$stop = page_stop_row();
$total = page_total_rows();

//ย้อนกลับไปอัปเดตการแสดงช่วงหัวข้อที่ section#top ด้วยคำสั่ง jQuery
$msg = "Order $start th - $stop th from $total";
echo "<script> $('section#top h3+span').html('$msg'); </script>"; //span ถัดจาก h3 ที่อยู่ใน section#top
	
mysqli_close($link);
?>

<div id="pagenum">
<?php		
if(page_total() > 1) {		//ถ้ามีจำนวนหน้ามากกว่า 1 ให้แสดงหมายเลขหน้า
	page_link_color("blue", "red");
	echo page_echo_pagenums();
}
?>
</div>
</section>

</article>

</div>
</body>
</html>