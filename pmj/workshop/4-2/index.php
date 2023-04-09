<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 4-2</title>
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
$mt = explode(" ", microtime());
$time_start = $mt[0] + $mt[1];

$go_on = true;
while($go_on) {
	$rand = rand();		//จะได้เลขที่มีค่าระหว่าง 0-32768
	if($rand == 9999) {
		$go_on = false;
	}
}
$mt = explode(" ", microtime());
$time_end = $mt[0] + $mt[1];

$difftime = $time_end - $time_start;
$time = round($difftime, 4);

echo "ใช้เวลาในการสุ่ม $time วินาที เพื่อให้ได้เลข 9999";
?>
</body>
</html>