<?php
function datetime_ago($datetime_string) {
	date_default_timezone_set('Asia/Bangkok');
	$ts = strtotime($datetime_string);
	$now = strtotime('now');
	if(!$ts || $ts > $now) {
		return false;
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
		$ago = round($diff/$year) . " ปีที่แล้ว";
	}	
	else if($diff >= $month) {
		$ago = round($diff/$month) . " เดือนที่แล้ว";
	}	
	else if($diff > $yesterday) {
		$ago = intval($diff/$day) . " วันที่แล้ว";
	}
	else if($diff <= $yesterday && $diff > $day) {
		$ago =  " เมื่อวานนี้";
	}
	else if($diff >= $hour) {
		$ago = intval($diff/$hour) . " ชั่วโมงที่แล้ว";
	}
	else if($diff >= $minute) {
		$ago = intval($diff/$minute) . " นาทีที่แล้ว";
	}	
	else if($diff >= 5*$second) {
		$ago = intval($diff/$second) . " วินาทีที่แล้ว";
	}
	else {
		$ago = "เมื่อสักครู่";
	}
	return $ago;
}
?>