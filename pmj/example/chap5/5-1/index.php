<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 5-1</title>
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
function get_microtime() {
	$mt = explode(" ", microtime());
	$time = $mt[0] + $mt[1];
	return $time;
}

$time_start = get_microtime();

$go_on = true;
while($go_on) {
	$rand = rand();		
	if($rand == 9999) {
		$go_on = false;
	}
}

$time_end = get_microtime();

$difftime = $time_end - $time_start;
$time = round($difftime, 4);
echo "ใช้เวลาในการสุ่ม $time วินาที เพื่อให้ได้เลข 9999";
?>
</body>
</html>