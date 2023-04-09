<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 12-1</title>
</head>

<body>
<?php
$link = mysqli_connect("localhost", "root", "abc456");
mysqli_query($link, "CREATE DATABASE IF NOT EXISTS pmj");
mysqli_select_db($link, "pmj");	
	
$sql = "CREATE TABLE IF NOT EXISTS pagination(
			id INT PRIMARY KEY AUTO_INCREMENT,
			item VARCHAR(150))";
				
mysqli_query($link, $sql);

$sql = "INSERT INTO pagination VALUES";
for($i = 1; $i <= 123; $i++) {
	if($i > 1) {
		$sql .= ",";
	}
	$sql .= "('', 'รายการลำดับที่ $i')";
}
$sql .= ";";
mysqli_query($link, $sql) or die(mysql_error($link));

echo "การสร้างตารางและเพิ่มข้อมูลเสร็จเรียบร้อย";
?>
</body>
</html>