<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 4-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	span {
		color: red;
	}
</style>
</head>

<body>
<?php
	date_default_timezone_set('Asia/Bangkok');
	echo "วันเวลาปัจจุบัน: " . date('Y/m/d H:i') . "<br>";
	
	$datetime_compare = "2014/05/20 14:55";   //ลองแก้ไขค่าวันเวลาที่นี่
	$ts = strtotime($datetime_compare);
	$now = strtotime('now');
	if(!$ts || $ts > $now) {
		exit;
	}

	$diff = $now - $ts;
	
	$second = 1;
	$minute = 60 * $second;
	$hour = 60 * $minute;
	$day = 24 * $hour;
	$yesterday = 48 * $hour;
    $month = 30 * $day;
	$year = 365 * $day;
	$ago = "";

	if($diff >= $year) {
		$ago = round($diff/$year) . " ปี ที่แล้ว";
	}	
	else if($diff >= $month) {
		$ago = round($diff/$month) . " เดือน ที่แล้ว";
	}	
	else if($diff > $yesterday) {
		$ago = intval($diff/$day) . " วัน ที่แล้ว";
	}
	else if($diff <= $yesterday && $diff > $day) {
		$ago =  " เมื่อวานนี้";
	}
	else if($diff >= $hour) {
		$ago = intval($diff/$hour) . " ชั่วโมง ที่แล้ว";
	}
	else if($diff >= $minute) {
		$ago = intval($diff/$minute) . " นาที ที่แล้ว";
	}	
	else if($diff >= 5*$second) {
		$ago = intval($diff/$second) . " วินาที ที่แล้ว";
	}
	else {
		$ago = "เมื่อสักครู่";
	}
	
	echo "วันเวลาที่โพสต์:  $datetime_compare &raquo; ";
	echo "<span>$ago</span>";
?>
</body>
</html>