<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456") or die(mysqli_connect_error());
/*
$sql = "CREATE DATABASE IF NOT EXISTS store";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างฐานข้อมูล: store สำเร็จ<br>";  }
else {  die("<br>สร้างฐานข้อมูล: store ล้มเหลว<br>" . mysqli_error($link)); }
*/

@mysqli_select_db($link, "store") or die(mysqli_error($link));

/*
$sql = 	"CREATE TABLE IF NOT EXISTS categories(
			 	cat_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	cat_name VARCHAR(200)			
			) AUTO_INCREMENT = 100";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: categories สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: categories ล้มเหลว<br>" . mysqli_error($link); }


$sql = 	"CREATE TABLE IF NOT EXISTS suppliers(
			 	sup_id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	sup_name VARCHAR(250),
 				address TEXT,
 				phone VARCHAR(50),
 				contact_name VARCHAR(200),
				website VARCHAR(250)
			) AUTO_INCREMENT = 1000";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: suppliers สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: suppliers ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS products(
			 	pro_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	cat_id SMALLINT UNSIGNED,
				sup_id SMALLINT UNSIGNED,
				pro_name VARCHAR(200),
				detail TEXT,
			 	price MEDIUMINT UNSIGNED,
				quantity SMALLINT UNSIGNED
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: products สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: products ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS attributes(
			 	attr_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	pro_id MEDIUMINT UNSIGNED,
				attr_name VARCHAR(100),
				attr_value VARCHAR(250)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: attributes สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: attributes ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS images(
			 	img_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	pro_id MEDIUMINT UNSIGNED,
				img_content MEDIUMBLOB
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: images สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: images ล้มเหลว<br>" . mysqli_error($link); }
*/

$sql = 	"CREATE TABLE IF NOT EXISTS cart(
			 	item_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
			 	pro_id MEDIUMINT UNSIGNED,
				attribute VARCHAR(100),
				quantity TINYINT UNSIGNED,
				date_shop DATETIME,
				session_id VARCHAR(32),
				PRIMARY KEY(pro_id, attribute)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: cart สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: cart ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS customers(
			 	cust_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				email VARCHAR(150) UNIQUE,
				password VARCHAR(20),
				firstname VARCHAR(50),
				lastname VARCHAR(100),
				address TEXT,
				phone VARCHAR(50)
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: customers สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: customers ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS orders(
			 	order_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				cust_id MEDIUMINT UNSIGNED,
				order_date DATETIME,
				paid SET('no', 'yes'),
				delivery SET('no', 'yes')
			) AUTO_INCREMENT = 1000000";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: orders สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: orders ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS order_details(
			 	item_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				order_id MEDIUMINT UNSIGNED,
			 	pro_id MEDIUMINT UNSIGNED,
				attribute VARCHAR(100),
				quantity TINYINT UNSIGNED
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: order_details สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: order_details ล้มเหลว<br>" . mysqli_error($link); }

$sql = 	"CREATE TABLE IF NOT EXISTS payments(
			 	pay_id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 	order_id MEDIUMINT UNSIGNED,
				cust_id MEDIUMINT UNSIGNED,
				bank VARCHAR(100),
				location  VARCHAR(100),
				amount  VARCHAR(20),
				transfer_date VARCHAR(20),
				confirm SET('no', 'yes')
			)";
if(@mysqli_query($link, $sql)) {   echo "<br>สร้างตาราง: payments สำเร็จ<br>";  }
else {  echo "<br>สร้างตาราง: payments ล้มเหลว<br>" . mysqli_error($link); }

@mysqli_close($link);
?>
</body>
</html>