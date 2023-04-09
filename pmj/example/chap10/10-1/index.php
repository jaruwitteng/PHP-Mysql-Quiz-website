<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 10-1</title>
<style>
	body {
		background: url(bg.jpg);
	}	
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error() . "</body></html>");
	

$sql = "SELECT COUNT(*) FROM people";
$rs = mysqli_query($link, $sql);
$row = mysqli_fetch_array($rs);
if($row[0] == 0) {
	
//คำสั่ง SQL สำหรับเพิ่มข้อมูลพร้อมกันหลายแถว 
$sql = "INSERT INTO people VALUES
	 	('', 'สมชาย พายเรือ', 'บางขุนเทียน กรุงเทพ', 
 		'somchai@example.com', '1975-01-10'),

	 	('', 'สมหญิง ยิงเรือ', 'บางบัวทอง นนทบุรี', 
 		'somying@example.com', '1976-10-01'),

	 	('', 'สมศรี ขี่เรือ', 'บางละมุง ชลบุรี', 
 		'somsri@example.com', '1977-12-21'),	
	
		('', 'สมศักดิ์ รักเรือ', 'บางพลี สมุทรปราการ', 
 		'somsak@example.com', '1978-11-11'),

	 	('', 'สมหวัง นั่งเรือ', 'บางปะอินทร์ อยุธยา', 
 		'somwang@example.com', '1979-10-10'),	

	 	('', 'สมพร นอนเรือ', 'บางระจันทร์ สิงห์บุรี', 
 		'somporn@example.com', '1980-03-30'),

	 	('', 'สมปอง มองเรือ', 'บางปะกง ฉะเชิงเทรา', 
 		'sompongmong@example.com', '1981-02-20'),

	 	('', 'สมพงษ์ ลงเรือ', 'บางเลน นครปฐม', 
 		'sompong@example.com', '1982-06-06')";
						
$r = mysqli_query($link, $sql);

if(!$r) { echo "การเพิ่มข้อมูล เกิดข้อผิดพลาด <br>"; }
else { echo "การเพิ่มข้อมูล เสร็จเรียบร้อย <br>"; }

}
mysqli_close($link);
?>
</body>
</html>