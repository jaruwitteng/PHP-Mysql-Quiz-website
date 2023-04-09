<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 			or die(mysqli_connect_error()."</div></article></body></html>");

//ถ้ายังไม่มีฐานข้อมูลและตารางให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
mysqli_query($link, $sql);
mysqli_select_db($link, "pmj");

$sql = "CREATE TABLE IF NOT EXISTS newsletter(
			email VARCHAR(200) UNIQUE, 
 			last_sent DATE)";
			
mysqli_query($link, $sql);
mysqli_close($link);
?>