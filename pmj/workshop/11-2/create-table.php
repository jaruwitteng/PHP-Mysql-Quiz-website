<?php
$link = @mysqli_connect("localhost", "root", "abc456");

//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
mysqli_query($link, $sql);
mysqli_select_db($link, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS webstats(
 			date_visited DATE,
			ip VARCHAR(30),
			browser VARCHAR(20),
			os VARCHAR(20),
			PRIMARY KEY(date_visited, ip))";
			
mysqli_query($link, $sql);
mysqli_close($link);
?>