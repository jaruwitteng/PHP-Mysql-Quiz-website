<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-5</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
</style>
</head>

<body>
<?php
$months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
 						 "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
						 
$today = "1/6/2014";
echo "<p>วันเดือนปีที่กำหนด: $today</p>";
$d = explode("/", $today);

$m = $months[$d[1]];  
$y = $d[2] + 543;  //แปลงเป็นปี พ.ศ.
echo "<p>วันเดือนปีแบบไทย: วันที่ $d[0] เดือน$m ปี $y <p><hr>";

$arr = array('One', 'Two', 'Three');
$str = implode("', '", $arr); //คั่นด้วย ',  ' ผลลัพธ์เป็น One', 'Two', 'Three
	
$str = "'" . $str  . "'"; //ปิดหัวท้ายให้ครบ
echo "สมาชิกในอาร์เรย์: " . $str;	//ผลลัพธ์เป็น 'One', 'Two', 'Three'
?>
</body>
</html>