<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 4-4</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		color: green;
	}
</style>
</head>
<body>
<?php
//ตำแหน่งไฟล์ของเพจนี้อาจกำหนดแบบนี้
//$file = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'];

$path =  $_SERVER['PHP_SELF'];  
$file = pathinfo($path, PATHINFO_BASENAME);  //ไฟล์ของเพจนี้

$bytes = filesize($file);
$size = $bytes . " Bytes" ;
if($bytes >= 1073741824) {   //1 GB
	$size = $bytes / 1073741824;
	$size = round($size, 2) . " GB";
}
else if($bytes >= 1048576) {   //1 MB
	$size = $bytes / 1048576;
	$size = round($size, 2) . " MB";
} 
else if($bytes >= 1024) {   //1 KB
	$size = $bytes / 1024;
	$size = round($size, 2) . " KB";
} 
echo "ไฟล์: $file มีขนาด $size";
?>
</body>
</html>