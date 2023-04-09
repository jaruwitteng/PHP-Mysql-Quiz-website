<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-7</title>
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
$rudes = array("xxx", "yyy", "zzz");	//สมมติว่าเป็นคำหยาบ
$msg = "I want zzz but she needs Xxx!";

$a = array();	//อาร์เรย์ว่างสำหรับเก็บคำหยาบที่พบ
foreach($rudes as $r) {
	if(stripos($msg, $r) != null) {  //ถ้ามีหยาบในสตริง
		array_push($a, $r); 			//ถ้าพบ ให้เก็บไว้ในอาร์เรย์
	}
}

if(count($a) > 0) {
	//รวมอาร์เรย์เป็นสตริงเดียวกันโดยคั่นด้วย  <br> เพื่อให้ขึ้นบรรทัดใหม่
	$str = implode("<br>", $a);
	echo "พบคำที่ไม่เหมาะสมคือ: <br>$str";
}
?>
</body>
</html>