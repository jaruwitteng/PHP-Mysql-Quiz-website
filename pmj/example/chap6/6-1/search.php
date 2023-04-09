<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 6-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
		text-align: center;
	}
	h4 > span {
		color: red;
	}
</style>
</head>

<body>
<?php
	$k = $_GET['keyword'];
?>
	<h4>ผลลัพธ์สำหรับการค้นหา: <span><?php echo $k; ?></span></h4>
</body>
</html>