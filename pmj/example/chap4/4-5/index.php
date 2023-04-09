<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 4-5</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	table {
		border-collapse: collapse;
		margin: auto;
	}
	th {
		background: green !important;
		color: yellow;
		padding: 4px;
		border: solid 1px white;
	}
	td {
		padding: 3px;
		border: solid 1px white;
	}
	td:nth-child(1) {
		width: 120px;
	}
	td:nth-child(2) {
		width: 80px;
		text-align: center;
	}
	td:nth-child(3) {
		width: 80px;
		text-align: right;
	}
	tr:nth-of-type(odd) {
		background: #cef;
	}
	tr:nth-of-type(even) {
		background: #ddd;
	}
</style>
</head>
<body>
<?php $path = "/xampp/htdocs"; ?>
<table>
<caption>รายชื่อไฟล์ใน:  <?php echo $path; ?></caption>
<tr>
	<th>ชื่อไฟล์</th><th>ชนิดไฟล์</th><th>ขนาด</th>
 </tr>
<?php
$dir = opendir($path);
while($file = readdir($dir)) {
 	if($file == "." || $file == "..") {
		continue;
	}
	$file_name = $file;
	
	//เนื่องจากผลลัพธ์ที่ได้จากฟังก์ชั่น readdir() มีเฉพาะชื่อไฟล์
	//แต่การอ่านข้อมูลต่างๆเกี่ยวกับไฟล์ต้องระบุตำแหน่งไปยังไฟล์นั้นด้วย
	//ดังนั้นจึงต้องนำชื่อไฟล์ไปต่อกับชื่อพาธที่จะอ่านรายการไฟล์
	$real_path = $path."/".$file;
	$type = "dir";
	if(is_file($real_path)) {   //ถ้าเป็นไฟล์ ให้ชนิดไฟล์คือส่วนขยายของไฟล์นั้น
		$info = pathinfo($real_path);  //ตำแหน่งของไฟล์นั้น
		$type = $info['extension'];
	}
	$size = filesize($real_path);   //หน่วยเป็น Bytes
	if($size >= 1048576) {  //ถ้ามีขนาดตั้งแต่ 1048576 ขึ้นไปให้แปลงเป็นหน่วย MB
		$size = round($size/1048576, 2) . " MB";
	}
	else if($size >= 1024) { 	//ถ้ามีขนาดตั้งแต่ 1024 ขึ้นไปให้แปลงเป็นหน่วย KB
		$size = round($size/1024, 2) . " KB";
	}
	echo "<tr>	<td>$file_name</td><td>$type</td><td>$size</td></tr>";
}
closedir($dir);
?>
</table>
</body>
</html>