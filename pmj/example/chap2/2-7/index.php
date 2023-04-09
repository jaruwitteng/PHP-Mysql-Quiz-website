<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-7</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
</style>
</head>

<body>
<?php
	$sum = 0;
	for($i = 1; $i <= 10; $i++) {
		if($i == 5) {
			break;
		}
		$sum += $i;
	}
	echo "Sum is: " . $sum;
?>
</body>
</html>