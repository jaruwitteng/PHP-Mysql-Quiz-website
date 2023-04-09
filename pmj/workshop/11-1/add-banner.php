<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 11-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
		min-width: 600px;
	}
	form {
		width: 600px;
		text-align: left;
		margin: auto;
		background: lavender;
	}
	div {
		background: #dd9;
		padding: 3px 0px;
	}
	div#top {
		border-bottom: solid 1px #999;
		font-size: 16px;
		color: green;
		margin-bottom: 10px;
		padding: 5px;
		border-radius: 4px 4px 0px 0px;
	}
	div#bottom {
		display: inline-block;
		border-top: solid 1px #999;
		margin-top: 10px;
		width: 100%;
		border-radius: 0px 0px 4px 4px;
		padding: 5px 0px;
	}
	img {
		margin: 3px 3px 3px 20px;
	}
	input, select {
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 3px;
		margin: 3px 3px 3px 20px;
	}
	input {
		width: 300px;
	}
	select {
		width: 100px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
	}
	button#back {
		margin-left: 5px;
	}
	button#submit {
		float: right;
		margin-right: 5px;
	}
	br.clear {
		clear: right;
	}
	button:hover {
		color: aqua;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 				or die(mysqli_connect_error()."</body></html>");

	$file = $_POST['file'];
	$url = $_POST['url'];
	$interval = $_POST['interval'];
	
	//เพิ่มข้อมูล banner โดยวันสิ้นสุดให้นับจากปัจจุบันไปเท่ากับจำนวนเดือนที่กำหนด
	//ส่วน impressions และ views กำหนดค่าให้เป็น 1 ไว้ทั้งคู่
	$sql = "INSERT INTO banner VALUES(
				'', '$file', '$url', DATE_ADD(CURRENT_DATE(), INTERVAL $interval MONTH), 1, 1)";
				
	$r = mysqli_query($link, $sql);
	if($r) {
		echo "<h3>เพิ่มข้อมูล banner แล้ว</h3>";
	}
	mysqli_close($link);
}
?>
<form method="post">
	<div id="top">เพิ่มป้ายโฆษณา</div>
	<input type="text" name="file" placeholder="ชื่อไฟล์ภาพ เช่น banner1.jpg" required>  ภาพที่เก็บไว้ในไดเร็กทอรี banner <br>
    <input type="text" name="url" placeholder="เว็บไซต์ที่จะเปิดเมื่อคลิกที่ป้าย" required>  ต้องขึ้นต้นด้วย http:// หรือ https:// <br>
     <select name="interval">
     <?php for($i = 1; $i <= 12; $i++) { echo "<option value=\"$i\">$i</option>";  }  ?>
     </select> เดือน (ระยะเวลาที่แสดงป้ายโฆษณา)
     <br>
	<div id="bottom">
		<button id="back" type="button" onclick="location='index.php'">ย้อนกลับ</button>
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
</body>
</html>