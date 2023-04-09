<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 10-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	form {
		display: inline-block;
		width: 350px;	
		margin: 20px auto;
	}
	label {
		display: inline-block;
		width: 80px;
	}
	div {
		display: inline-block;
		width: auto;
		padding: 5px 10px;
		text-align: left;
	}
	div:first-child {
		background: #cfc;
		border-radius: 5px 5px 0px 0px;
		border-bottom: solid 1px silver;
	}
	div:last-child {
		background: #ccc;
		border-radius: 0px 0px 5px 5px;
		border-top: solid 1px white;
	}
	select {
		width: 200px;
		margin-right: 10px;
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 			or die(mysqli_connect_error() . "</body></html>");

//เมื่อโหลดเพจ ให้อ่านรายชื่อฐานข้อมูล
$sql = "SHOW DATABASES";
$r = mysqli_query($link, $sql);
?>
<form method="post">
<?php
	echo '<div><label>ฐานข้อมูล: </label>';
	
	//ที่ select จะแทรกคำสั่งจาวาสคริปต์
	//เพื่อให้เกิดการโพสต์กลับขึ้นไปทันทีที่เลือกชื่อฐานข้อมูล
	echo '<select name="db" onchange="form.submit()">';
	
	//ถ้าไม่มีข้อมูลแสดงว่าเป็นการเปิดเพจครั้งแรก ให้ตัวเลือกอันแรก
	//เป็นการแจ้งให้ผู้ใช้ต้องเลือกชื่อฐานข้อมูล
	if(!$_POST['db']) {
		echo "<option>กรุณาเลือกฐานข้อมูล</option>";
	}
	//นำรายชื่อฐานข้อมูลไปแสดงเป็นรายการของ select
	while($db = mysqli_fetch_array($r)) {
		echo "<option value=\"{$db[0]}\"";
		//ถ้าเป็นการโพสต์ชื่อฐานข้อมูลกลับเข้ามา แล้วฐานข้อมูลนั้น
		//ตรงกับรายการที่กำลังจะแสดง ก็ให้รายการนั้นถูกเลือก (ความรู้จากบทที่ 6)
		if($_POST['db'] == $db[0]) {
			echo " selected";
		}
		echo ">{$db[0]}</option>";
	}
	echo '</select>';
 	echo '</div><br>';
	
	//ถ้ามีการโพสต์ชื่อฐานข้อมูลเข้ามา ก็ให้อ่านชื่อตารางที่อยู่ในฐานข้อมูลนั้น
 	if($_POST['db']) {
		$db = $_POST['db'];
		$sql = "SHOW TABLES FROM $db";
		$r = mysqli_query($link, $sql);
		
		echo '<div>';
		echo '<label>ตาราง: </label>';
		//นำชื่อตารางไปสร้างเป็นรายการของ select อันที่สอง
		echo '<select name="tb">';
		while($tb = mysqli_fetch_array($r)) {
			echo "<option value=\"{$tb[0]}\">{$tb[0]}</option>";
		}
		echo '</select>';
		echo '</div>';
	}
	
mysqli_close($link);
?>	
</form>
</body>
</html>