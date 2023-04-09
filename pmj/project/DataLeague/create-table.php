<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data League</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456") or die(mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS dataleague";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: dataleague สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: dataleague ล้มเหลว<br>" . mysqli_error($link)); }

@mysqli_select_db($link, "dataleague") or die(mysqli_error($link));

$sql = 	"CREATE TABLE IF NOT EXISTclubs(
			 	club_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	league VARCHAR(3),
			 	club_name VARCHAR(100),
				logo VARCHAR(50),
 				played TINYINT UNSIGNED,
				won  TINYINT UNSIGNED,
				drawn TINYINT UNSIGNED,
				lost TINYINT UNSIGNED,
				points TINYINT,
				goals_for TINYINT,
				goals_against TINYINT,
 				goals_diff TINYINT				
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: clubs สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: clubs ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS matches(
			 	match_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				match_datetime DATETIME,
			 	league VARCHAR(3),
			 	home_id SMALLINT UNSIGNED,
				away_id SMALLINT UNSIGNED,
				watch VARCHAR(250),
				home_goals TINYINT UNSIGNED,
				away_goals TINYINT UNSIGNED
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: matchs สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: matchs ล้มเหลว<br>" . mysqli_error($link); }

@mysqli_close($link);
?>
</body>
</html>