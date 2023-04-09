<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 				or die(mysqli_connect_error());
				
//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
mysqli_query($link, $sql);
mysqli_select_db($link, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS rating_item(
			item_id  SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			name  VARCHAR(200),
			detail TEXT,
			image VARCHAR(150))";
			
mysqli_query($link, $sql);

$sql = "CREATE TABLE IF NOT EXISTS rating_star(
			item_id  SMALLINT UNSIGNED,
			ip VARCHAR(15),
			star MEDIUMINT UNSIGNED,
			PRIMARY KEY(item_id, ip))";
			
mysqli_query($link, $sql);

$sql = "SELECT COUNT(*) FROM rating_item";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);
if($data[0] == 0) {
	$sql = "REPLACE INTO rating_item VALUES
		 		('', 'เสื้อ G-Shirt', 'เสื้อเชิ้ตที่เหมาะสมที่สุดสำหรับคุณสุภาพสตรีในยุค 3G ให้คุณสวมใส่เพื่อก้าวข้ามไปสู่ Generation ใหม่ได้อย่างเต็มภาคภูมิ', 'g-shirt.jpg'),
				('', 'กระเป๋า Flower Bag', 'ดอกไม้หลากหลายสีสันบนตัวกระเป๋ายังช่วยเพิ่มความโดดเด่น บ่งบอกถึงรสนิยมอย่างมีระดับในตัวคุณ', 'flower-bag.jpg'),
				('', 'เสื้อ V-Shirt', 'สวมใส่ได้ทุกที่ทุกเวลาทุกสภาพดินฟ้าอากาศและทุกภูมิภาค ช่วยเสริมสร้างความโดดเด่นอันป็นเอกลักษณ์แก่ผู้สวมใส่', 'v-shirt.jpg')";
}
mysqli_query($link, $sql);

mysqli_close($link);
?>