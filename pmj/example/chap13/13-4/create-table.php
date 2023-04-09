<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 			or die(mysqli_connect_error()."</body></html>");

//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
@mysqli_query($link, $sql);
@mysqli_select_db($link, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS files(
			file_id MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			file_name VARCHAR(160) UNIQUE, 
			file_type VARCHAR(100),
			file_content BLOB)";
			
mysqli_query($link, $sql);

mysqli_close($link);
?>