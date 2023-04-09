<?php
sleep(1);
session_start();

//กรณีกำหนดชื่อเป็นค่า null ถ้ามีชื่อในเซสชั่น ให้เข้าสู่การแชท
if(empty($_POST['name']) && isset($_SESSION['name'])) {
	echo "displayChat();";   //ฟังก์ชั่นจาวาสคริปต์ อยู่ที่ index.php
	$name = $_SESSION['name'];
	echo "\$('#chitchat').dialog('option', 'title', '$name');";  //ใส่ชื่อบน titlebar ของไดอะล็อก
	exit();
}
//กรณีกำหนดชื่อเป็นค่า null แต่มีชื่อในเซสชั่น ให้สร้าง
else if(empty($_POST['name']) && !isset($_SESSION['name'])) {
	echo "enterName();";   //ฟังก์ชั่นจาวาสคริปต์ อยู่ที่ index.php
	exit();
}

//กรณีกำหนดชื่อในช่อง text แล้วส่งเข้ามา
include "dblink.php";

//เนื่องจากไม่มีระบบสมาชิก  และมีแค่ตารางเดียวในการจัดเก็บและตรวจสอบข้อมูล
//ซึ่งจะเกิดปัญหาในกรณีที่ ถ้าเคยมีผู้ใช้ชื่อนั้นมาแล้ว จะทำให้คนอื่นไม่สามารถใช้ชื่อนั้นได้อีก
//แม้ว่าคนที่เคยใช้ชื่อนั้น จะไม่เลิกแชทไปแล้วก็ตาม ดังนั้นเพื่อเป็นการแก้ปัญหานี้
//ในที่นี้จึงจะใช้วิธีลบข้อความที่ส่งเข้ามาแล้วเกินกว่า 1 วันทิ้งไป 
//ซึ่งจะส่งผลให้ชื่อที่มีผู้เคยใช้ว่างลงไปด้วย ทำให้คนอื่นสามารถใช้ชื่อนั้นได้
$sql = "DELETE FROM chitchat WHERE DATEDIFF(NOW(), date_post ) > 1";
mysqli_query($link, $sql);

//ตรวจสอบว่าชื่อซ้ำหรือไม่
$name = $_POST['name'];
$sql = "SELECT * FROM chitchat WHERE name = '$name'";
$rs = mysqli_query($link, $sql);
if(mysqli_num_rows($rs) == 0) {	  //ถ้าชื่อไม่ซ้ำ
	$_SESSION['name'] = $name;  //จัดเก็บชื่อในเซสชั่น ซึ่งนำไปใช้ในขั้นตอนการส่งข้อความ
	echo "displayChat();";				  //แสดงอิลิเมนต์ในการแชท(ฟังก์ชั่นจาวาสคริปต์)
	echo "\$('#chitchat').dialog('option', 'title', '$name');";   //ใส่ชื่อบน titlebar ของไดอะล็อก
}
else {
	echo "alert('ชื่อ: $name มีผู้ใช้แล้ว กรุณาเปลี่ยนใหม่'); enterName();";	
}
mysqli_close($link);
?>