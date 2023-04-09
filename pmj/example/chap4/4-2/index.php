<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 4-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
	}
</style>
</head>

<body>
<?php
date_default_timezone_set('Asia/Bangkok');
$birth = strtotime("01/10/2000");
echo date("ดิฉันเกิดเมื่อ j-m-Y", $birth);

$days = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
 								"กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

$d = date('w');  			//ลำดับของวันในรอบสัปดาห์(0-6)
$day = $days[$d];  	//ชื่อวันเป็นภาษาไทย

$date = date('j');  		//วันที่

$m = date('n');			//ลำดับของเดือนแบบไม่มี 0 นำหน้า(1-12)
$month = $months[$m];

$year = date('Y') + 543;  //ปี พ.ศ.
echo "<br>วันนี้ตรงกับวัน $day วันที่ $date เดือน $month ปี $year <br>";
echo date("ขณะนี้เวลา H:i:s");
?>
</body>
</html>