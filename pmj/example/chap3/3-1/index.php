<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-1</title>
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
$a = array('th'=>"Thailand", 'jp'=>"Japan", 'kr'=>"Korea");

//ใช้ลูป while เพื่อให้เลื่อนพอยเตอร์ไปเรื่อยๆจนกว่าจะคืนค่า false
while(list($key, $value) = each($a)) {
	echo "$key => $value <br>";
}
?>
</body>
</html>