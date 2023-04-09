<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-8</title>
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
 	echo "Sum of 1 - ";

 	for($i = 1; $i <= 10; $i++) {
 	 	$sum += $i;
	 	if($sum >= 30) {
		 	$x = $i;
		 	exit;
	 	}
 	}
 	echo "$x = $sum";
?>

</body>
</html>