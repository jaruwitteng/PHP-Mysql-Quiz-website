<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-6</title>
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
$str = "การตัดคำที่เป็นภาษาไทย";
echo "ข้อความเดิม: $str<br>";

$substr = substr($str, 0, 10);
echo "ใช้ substr(): $substr <br>";

$mb_substr = mb_substr($str, 0, 10, 'utf-8');
echo "ใช้ mb_substr(): $mb_substr";
?>
</body>
</html>