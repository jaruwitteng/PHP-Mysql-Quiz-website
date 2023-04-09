<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 5-3</title>
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
function get_filesize($file, $precision=2) {
	$bytes = filesize($file); //ลองกำหนดขนาดลงไปเองก็ได้ เช่น 123456
	$units = array("GB"=>1073741824, "MB"=>1048576, "KB"=>1024);
	foreach($units as $u => $v) {
		if($bytes >= $v) {
			return  round(($bytes/$v), $precision) . " $u";
		}
	}
	return $bytes . " Bytes";   //กรณีที่ไม่สามารถเปลี่ยนเป็นหน่วยใดในอาร์เรย์ ให้ส่งกลับค่านี้
}

$path =  $_SERVER['PHP_SELF'];  
$file = pathinfo($path, PATHINFO_BASENAME);  //ไฟล์ของเพจนี้
echo "ไฟล์: $file มีขนาด " . get_filesize($file);
?>
</body>
</html>