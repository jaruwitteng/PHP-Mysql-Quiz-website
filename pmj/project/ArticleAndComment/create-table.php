<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article & Comment</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456") or die(mysqli_connect_error());

$sql = "CREATE DATABASE IF NOT EXISTS articlecomment";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: articlecomment สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: articlecomment ล้มเหลว<br>" . mysqli_error($link)); }

@mysqli_select_db($link, "articlecomment") or die(mysqli_error($link));

$sql = 	"CREATE TABLE IF NOT EXISTS image(
			 	image_id MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			 	image_content MEDIUMBLOB
 			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: image สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: image ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS article(
			 	article_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	topic VARCHAR(150),
			 	article_text TEXT,
				writer VARCHAR(100),
				allow_comment  SET('yes', 'no'),
			 	date_post DATETIME,
				views  MEDIUMINT UNSIGNED,
				image_id MEDIUMINT UNSIGNED 
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: article สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: article ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS comment(
				comment_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				link_id MEDIUMINT UNSIGNED,
				comment_type SET('c', 'r'), 
			 	comment_text TEXT,
				commentator  VARCHAR(100),
				date_post DATETIME,
				image_id  MEDIUMINT UNSIGNED
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: comment สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง:comment ล้มเหลว<br>" . mysqli_error($link); }

@mysqli_close($link);
?>
</body>
</html>