<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 5-4</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
	}
</style>
</head>

<body>
<?php
function swap(&$x, &$y) {	//อาร์กิวเมนต์ทั้ง 2 ตัวแปรรับค่าแบบ reference
	$temp = $x;
	$x = $y;
	$y = $temp;
}

$x = 66;
$y = 99;
echo "ก่อนเรียกฟังก์ชั่น swap() : ";
echo "\$x = $x, \$y = $y <br>";

swap($x, $y);
echo "หลังเรียกฟังก์ชั่น swap() : ";
echo "\$x = $x, \$y = $y";
?>
</body>
</html>