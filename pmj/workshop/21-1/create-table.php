<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 				or die(mysqli_connect_error());

//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
mysqli_query($link, $sql);
mysqli_select_db($link, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS scroll_update(
			id  TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			message  VARCHAR(200))";
			
mysqli_query($link, $sql);

$sql = "SELECT COUNT(*) FROM scroll_update";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);
if($data[0] == 0) {
	for($i = 1; $i <= 50; $i++) {
		$sql = "INSERT INTO scroll_update VALUES('', 'ข้อความลำดับที่ $i')";
		mysqli_query($link, $sql);
	}
}
mysqli_close($link);
?>