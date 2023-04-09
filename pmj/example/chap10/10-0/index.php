<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 10-0</title>
<style>
	body {
		background: url(bg.jpg);
	}	
</style>
</head>

<body>
<?php
//ลองทำให้เกิดข้อผิดพลาด เช่น ใส่รหัสผ่านผิด
$link = @mysqli_connect("localhost", "root", "xxx");
 			
if($link) {
	echo "การเชื่อมต่อครั้งที่ 1 สำเร็จ <hr>";
}
else {
	echo "การเชื่อมต่อครั้งที่ 1 ล้มเหลว <br>";
	echo mysqli_connect_error() . "<hr>";
}

$link = @mysqli_connect("localhost", "root", "abc456");
if($link) {
	echo "การเชื่อมต่อครั้งที่ 2 สำเร็จ <hr>";
	mysqli_close($link);   //ลองปิดการเชื่อมต่อดูว่าจะมีผลอย่างไร
}
else {
	echo "การเชื่อมต่อครั้งที่ 2 ล้มเหลว <br>";
	echo mysqli_connect_error() . "<hr>";
}

 //เลือกฐานข้อมูลหลังจากปิดการเชื่อมต่อไปแล้ว
$select_db = @mysqli_select_db($link, "pmj");	
if($select_db) {
	echo "เลือกฐานข้อมูลครั้งที่ 1 สำเร็จ <hr>";
}
else {
	echo "เลือกฐานข้อมูลครั้งที่ 1 ล้มเหลว";
	echo mysqli_error($link) . "<hr>";
}

//เปิดการเชื่อมต่อใหม่อีกครั้ง
$link = @mysqli_connect("localhost", "root", "abc456")
			or die(mysqli_connect_error());
			
//ลองเลือกฐานข้อมูลใหม่อีกครั้ง หลังเปิดการเชื่อมต่อ
$select_db = @mysqli_select_db($link, "pmj");	
if($select_db) {
	echo "เลือกฐานข้อมูลครั้งที่ 2 สำเร็จ <hr>";
}
else {
	echo "เลือกฐานข้อมูลครั้งที่ 2 ล้มเหลว <br>";
	echo mysqli_error($link) . "<hr>";
}

mysqli_close($link);
?>
</body>
</html>