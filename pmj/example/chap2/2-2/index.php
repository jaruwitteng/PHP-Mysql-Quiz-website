<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
</style>
</head>

<body>
<?php
 		$q = "php mysql jquery";
 		$b = 1;
		$n = 10;
		$t = 1000;

		echo '<b>Single Quotes</b><br>
				ค้นหา: $q  ผลลัพธ์ลำดับที่ $b - $n จากทั้งหมด $t';

		echo "<br><br>";

		echo "<b>Double Quotes</b><br>
 				ค้นหา: $q  ผลลัพธ์ลำดับที่ $b - $n จากทั้งหมด $t";
?>
</body>
</html>