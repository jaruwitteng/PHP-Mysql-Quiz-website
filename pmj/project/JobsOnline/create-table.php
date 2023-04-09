<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456") or die(mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS jobsonline";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: jobsonline สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: jobsonline ล้มเหลว<br>" . mysqli_error($link)); }

@mysqli_select_db($link, "jobsonline") or die(mysqli_error($link));

$sql = 	"CREATE TABLE IF NOT EXISTS jobs(
			 	job_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	position VARCHAR(150),
			 	quantity VARCHAR(50),
			 	description TEXT,
			 	date_post DATETIME
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: jobs สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: jobs ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS qualification(
				qual_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				job_id SMALLINT UNSIGNED,
			 	qual_text VARCHAR(250)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: qualification สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: qualification ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS resume(
			 	resume_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				name VARCHAR(150),
				age VARCHAR(20),
				address TEXT,
				phone VARCHAR(100),
				email VARCHAR(150),
				expect_jobs VARCHAR(200),
			 	expect_salary VARCHAR(100),
				lang VARCHAR(150),
				computing VARCHAR(250),
				other_skill VARCHAR(250),
			 	driving SET('yes', 'no'),
				driving_license SET('yes', 'no'),
				own_car SET('yes', 'no'),
				date_post DATE
			 )";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: resume สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: resume ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS experience(
				 exp_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				 resume_id MEDIUMINT,
				 position VARCHAR(150),
				 workplace VARCHAR(200),
				 period VARCHAR(30)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: experience สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: experience ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS education(
				edu_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	resume_id MEDIUMINT UNSIGNED,
				level VARCHAR(100),
				academy VARCHAR(250),
			 	major VARCHAR(150)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: education สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: education ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS image(
			 	resume_id MEDIUMINT UNSIGNED PRIMARY KEY,
			 	img_content MEDIUMBLOB
 			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: image สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: image ล้มเหลว<br>" . mysqli_error($link); }

@mysqli_close($link);
?>
</body>
</html>