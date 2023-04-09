<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 5-1</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
	}
</style>
</head>

<body>
<?php
function thai_date($datetime_string) {
	date_default_timezone_set('Asia/Bangkok');
	$ts = strtotime($datetime_string);
	if(!$ts) {
		return array();
	}
	
	$days = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
 								"กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
								
	$months_short = array(1=>"ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", 
 								"ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");								

	$d = date('w', $ts);  			//ลำดับของวันในรอบสัปดาห์(0-6)
	$day = $days[$d];  			//ชื่อวันเป็นภาษาไทย

	$date = date('j', $ts);  		//วันที่

	$m = date('n', $ts);			//ลำดับของเดือนแบบไม่มี 0 นำหน้า(1-12)
	$month = $months[$m];	
	
	$month_short = $months_short[$m];
	
	$year = date('Y', $ts) + 543;
	
	return array('day'=>$day, 'date'=>$date, 'month'=>$month, 'year'=>$year, 'month_short'=>$month_short);
}

$td = thai_date('now');
echo "วันที่ผลิต ".$td['date']." ".$td['month']." ".$td['year'];
echo "<br>";

$td = thai_date('+180 days');
echo "หมดอายุ {$td['date']} {$td['month']} {$td['year']}";
?>
</body>
</html>