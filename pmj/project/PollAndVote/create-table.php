<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456")
 				or die(mysqli_connect_error());
				
//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS poll";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: poll สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: poll ล้มเหลว<br>" . mysqli_error($link)); }

mysqli_select_db($link, "poll");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS poll_topic(
			topic_id  SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			topic_text  VARCHAR(250),
			status SET('active', 'inactive'))";
			
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: poll_topic สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: poll_topic ล้มเหลว<br>" . mysqli_error($link); }

$sql = "CREATE TABLE IF NOT EXISTS poll_choice(
			choice_id  MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			topic_id  SMALLINT UNSIGNED,
			choice_text VARCHAR(250),
			score  MEDIUMINT UNSIGNED,
			graph_color VARCHAR(7))";
			
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: poll_choice สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: poll_choice ล้มเหลว<br>" . mysqli_error($link); }

$sql = "CREATE TABLE IF NOT EXISTS poll_ip(
			topic_id  SMALLINT UNSIGNED,
			ip VARCHAR(15),
			PRIMARY KEY(topic_id, ip))";
			
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: poll_ip สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: poll_ip ล้มเหลว<br>" . mysqli_error($link); }

mysqli_close($link);
?>
</body>
</html>