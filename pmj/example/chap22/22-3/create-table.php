<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 22-3</title>
</head>

<body>
<?php
	$link = mysqli_connect("localhost", "root", "abc456");
	mysqli_query($link, "CREATE DATABASE IF NOT EXISTS pmj");
	mysqli_select_db($link, "pmj");
	$sql = "CREATE TABLE IF NOT EXISTS datepicker(
				dt DATE PRIMARY KEY,
				note MEDIUMTEXT)";
				
	mysqli_query($link, $sql);
	
	$sql = "INSERT INTO datepicker VALUES
				(SUBDATE(NOW(),0), 'ไปพันธุ์ทิพย์, ประตูน้ำ, เซ็นทรัลเวิลด์, มาบุญครอง, ฯลฯ'), 
				(SUBDATE(NOW(),1), 'ไปเที่ยวหัวหินกับครอบครัว'), 
				(SUBDATE(NOW(),2), 'ฝนตกหนัก อยู่บ้านทั้งวัน'), 
				(SUBDATE(NOW(),3), 'ไม่สบาย ไปหาหมอที่โรงพยาบาลรามา'), 
				(SUBDATE(NOW(),4), 'ไปร่วมงานเลี้ยงศิษย์เก่า คืนสู่เหย้าชาว...'), 
				(SUBDATE(NOW(),5), 'ไปทำบุญที่วัดป่ามะม่วง'), 
				(SUBDATE(NOW(),6), 'ไปอบรมสัมมนาที่ต่างจังหวัด')";
	
	mysqli_query($link, $sql);
	mysqli_close($link);
?>
</body>
</html>