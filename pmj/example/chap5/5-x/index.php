<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 5-x</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
		text-align: center;
	}
</style>
</head>

<body>
<?php
function is_valid_rgb($num) {
	if($num >= 0 && $num <= 255) {
		return true;
	}
	else {
		return false;
	}
}
function rgb2hex($red, $green, $blue) {
	if(!is_valid_rgb($red) || !is_valid_rgb($green) || !is_valid_rgb($blue)) {
		$red = 0;
		$green = 0;
		$blue = 0;
	}
	return "#" . dechex($red) . dechex($green) . dechex($blue);
}

echo "rgb(255,255,255) => " . rgb2hex(255,255,255);
?>
</body>
</html>