<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 4-3</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
		text-align: center;
	}
	div#visitor {
		width: 100%;
		position: fixed;
		left: 0px;
		bottom: 5px;
		text-align: center;
		font-size: 16px !important;
	}
	div#visitor span {
		font-size: 18px !important;
		color: brown;		
	}
</style>
</head>

<body>
<?php
$f = "counter.txt";  //ชื่อไฟล์สำหรับเก็บข้อมูล
$v = 0;
if(file_exists($f)) {   //ถ้ามีไฟล์อยู่แล้ว ให้ค่ามาใช้
	$v = file_get_contents($f);
}
else {
	$v = 1000;  //กำหนดค่าเริ่มต้นที่ต้องการ
}

$v = intval($v) + 1;		//เพิ่มค่าจากเดิมไปอีก 1

//สัญลักษณ์ที่ใช้แทน HTML Decimal จาก 0-9
$html_decimal = array("&#9450;", "&#9312;", "&#9313;", "&#9314;", "&#9315;", 
 								"&#9316;", "&#9317;", "&#9318;", "&#9319;", "&#9320;");
$visitor = number_format($v);
$len = strlen($visitor);
$counter = "";
for($i = 0; $i < $len; $i++) {
	$n = $visitor[$i];  //จากหลักการที่ว่าสตริงคืออาร์เรย์ของอักขระ เราก็อ่านอักขระลำดับที่ $i
	if($n != ",") {  //หลังจากใช้ number_format() อาจมี "," คั่นหลักพัน
		$counter .= $html_decimal[$n];
	}
	else {
		$counter .= ",";
	}
}
echo "<div id=\"visitor\">ผู้เยี่ยมชมลำดับที่:<span>$counter</span></div>";

//อัปเดตตัวนับเดิม โดยเขียนทับจำนวนเดิม (ถ้าไม่มีไฟล์อยู่ก่อน ไฟล์จะถูกสร้างให้เอง)
file_put_contents($f, $v);
?>
</body>
</html>