<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 			or die(mysqli_connect_error()."</body></html>");

//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
mysqli_query($link, $sql);
mysqli_select_db($link, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่ ... date_end  คือวันที่สิ้นสุดการโฆษณา
//impressions คือจำนวนคลิก, views  คือจำนวนที่แสดง
$sql = "CREATE TABLE IF NOT EXISTS banner(
				bid SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				filename VARCHAR(50),
 				url VARCHAR(250),
				date_end DATE,
				impressions MEDIUMINT UNSIGNED,   
				views MEDIUMINT UNSIGNED)";
			
mysqli_query($link, $sql);
mysqli_close($link);
?>