<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS webtesting";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: webtesting สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: webtesting ล้มเหลว<br>" . mysqli_error($link)); }

@mysqli_select_db($link, "webtesting") or die(mysqli_error($link));

$sql = 	"CREATE TABLE IF NOT EXISTS subject(
			 subject_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 subject_text VARCHAR(200),
			 date_test DATE,
			 time_start TIME,
			 time_end TIME)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: subject สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: subject ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS question(
			 question_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 subject_id SMALLINT UNSIGNED,
			 question_text TEXT,
			 image MEDIUMBLOB)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: question สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: question ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS choice(
			 choice_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 question_id MEDIUMINT UNSIGNED,
			 choice_text VARCHAR(250),
			 answer SET('yes', 'no'))";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: choice สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: choice ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS testee(
			 testee_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 login VARCHAR(100) UNIQUE,
			 password VARCHAR(20),
			 firstname VARCHAR(50),
			 lastname VARCHAR(100),
			 code VARCHAR(20))";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: testee สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: testee ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS testing(
			 testee_id MEDIUMINT UNSIGNED,
			 subject_id SMALLINT UNSIGNED,
			 question_id MEDIUMINT UNSIGNED,
			 choice_id INT UNSIGNED,
			 PRIMARY KEY(testee_id, subject_id, question_id))";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: testing สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: testing ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS score(
			 testee_id MEDIUMINT UNSIGNED,
			 subject_id SMALLINT UNSIGNED,
			 amount SMALLINT UNSIGNED,
			 PRIMARY KEY(testee_id, subject_id))";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: score สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: score ล้มเหลว<br>" . mysqli_error($link); }

@mysqli_close($link);
?>
</body>
</html>