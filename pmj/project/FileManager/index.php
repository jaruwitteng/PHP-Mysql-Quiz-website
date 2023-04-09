<?php include "check-login.php";  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
<style>
	@import 'global.css';
	
	section#breadcrumbs span.curdir {
		color: red;
	}
	table {
		width: 100%;
		border-collapse: collapse;
	}
	tr:first-child td {
		background: #9c9 !important;
		color: navy;
		text-align:center !important;
		font-size: 11pt;
		font-weight: bold;	
	}
	tr:nth-of-type(odd) {
		background-color: #ccf;
	}
	tr:nth-of-type(even) {
		background-color: #eef;
	}
	td {
		font: 11pt tahoma;
		border: solid 1px white;
		padding: 5px 3px;
	}
	td:nth-child(1) {
		width: 43%;
	}
	td:nth-child(2) {
		width: 12%;
		text-align: center;
	}
	td:nth-child(3) {
		width: 12%;
		text-align: right;
	}
	td:nth-child(4) {
		width: 33%;
		text-align: center;
	}
	a.disabled {
		background: lightgray !important;
		color: silver !important;
		cursor: default !important;
		border-color: silver !important;
	}
	a.folder {
		background: gold !important;
	}
	td:nth-child(1) > img {
		width: 16px;
		height: 16px;
		margin-right: 5px;
	}
	td:nth-child(4) > a {
		border: solid 1px orange;
		border-radius: 6px;
		padding: 1px 5px;
		cursor: pointer;
		margin: 0px 3px;
		font: 10pt tahoma;
	}
	td:nth-child(4) > a:nth-child(1) {
		background-color: lightgreen;
	}
	td:nth-child(4) > a:nth-child(2) {
		background-color: paleturquoise;
	}
	td:nth-child(4) > a:nth-child(3) {
		background-color: thistle;
	}
	td:nth-child(4) > a:nth-child(4) {
		background-color: #f93;
	}
	td:nth-child(4) > a:hover { 
		color: red;
		background-color: #ff9;
	}
</style>
</head>
<body>
<?php
//โดยเริ่มแรกต้องตรวจสอบก่อนว่ามีพาธที่แนบมากับ URL หรือไม่ 
//หากไม่มีเริ่มต้นที่ไดเร็กทอรี document root
$root = $_SERVER['DOCUMENT_ROOT'];
$path = $root;
if(isset($_GET['path'])) {
	$path = $_GET['path'];
	if(!file_exists($path)) {
		exit("<h3>ไม่พบพาธ: $path</h3></body></html>");
	}
}
?>
<div id="container">
<header>
	<a href="logout.php">ออกจากระบบ</a>
	<div id="logo">PHP File Manager</div>
</header>
<nav>
	<img src="images/home.png" height="30"><span>หน้าหลัก</span>
	<a href="newfile.php?path=<?php echo $path; ?>" target="_blank">สร้างไฟล์ใหม่</a>
	<a href="newdir.php?path=<?php echo $path; ?>" target="_blank">สร้างไดเร็กทอรีใหม่</a>
	<a href="upload.php?path=<?php echo $path; ?>" target="_blank">อัปโหลด</a>
</nav>
<section id="breadcrumbs">
<?php
//สร้างลิงค์ของแต่ละไดเร็กทอรีของพาธตามแนวทางได้กล่าวมาแล้ว
$dirname = dirname($root);     //ถ้า $root = "C:/xampp/htdocs" => $dirname = "C:/xampp";
$basename = basename($root);		//ถ้า $root = "C:/xampp/htdocs" => $basename = "htdocs";

//เนื่องจากเราต้องการให้การแสดงเส้นทางไดเร็กทอรีของ breadcrumbs นั้นเริ่มจาก document root (ในที่นี้คือ htdocs)
//แต่ค่า document root ที่อ่านมาได้ มีไดเร็กทอรีที่อยู่ก่อนนี้ติดมาด้วย (ในที่นี้คือ C:/xampp) 
//ซึ่งค่านี้เราอ่านด้วยฟังก์ชั่น dirname() มาเก็บไว้แล้ว ดังนั้นเพื่อคัดเอาเฉพาะไดเร็กทอรีตั้งแต่ document root เป็นต้นไป 
//เราอาจเลือกใช้วิธีแทนที่ไดเร็กทอรีที่อยู่ก่อน document root ด้วยช่องว่าง  
$breadcrumb_str = str_ireplace("$dirname/", "", $path);  //เช่น จาก C:/xampp/htdocs/dir1/dir2 => htdocs/dir1/dir2  

//เราต้องการทำแต่ละไดเร็กทอรี ให้กลายเป็นลิงก์ จึงนำมาคัดแยกออกจากกันด้วย "/"
$dirs = explode("/", $breadcrumb_str);
$url = $_SERVER['PHP_SELF'];
$realpath = $dirname;

//เปลี่ยนแต่ละไดเร็กทอรีให้กลายเป็นลิงก์
for($i = 0; $i < count($dirs); $i++) {
	if($i > 0) {
		echo " &raquo; ";  	//ใช้สัญลักษณ์ >> แบ่งระหว่าง dir ในการแสดง breadcrumbs เช่น htdocs >> dir1 >> dir2
	}
	
	//การจะเปิดไดเร็กทอรีได้ ต้องระบุเป็นเส้นทางจริงมายังไดเร็กทอรีนั้น
	//ดังนั้นเราต้องนำเส้นทางก่อนจะถึงไดเร็กทอรีนี้มาเชื่อมต่อด้วย 
	//เช่นถ้า breadcrumbs_str = htdocs/dir1/dir2/dir3 
	//และต้องการสร้างลิงก์ของไดเร็กทอรี htdocs เราต้องนำไดเร็กทอรีก่อนนี้คือ C:/xampp/
	//มาเชื่อมต่อกันเข้าไปเรื่อยๆ ให้เป็นเส้นทางที่แท้จริงของไดเร็กทอรีนั้น
	$realpath .=  "/" . $dirs[$i];	
	
	//ไดเร็กทอรีปัจจุบัน(ชั้นในสุด) ไม่ต้องทำลิงก์
	if($dirs[$i] == basename($path)) {
		echo "<span class=\"curdir\">{$dirs[$i]}</span>";	
		continue;
	}
	//สร้างลิงก์ให้กับไดเร็กทอรีนั้น ซึ่งเมื่อคลิกที่ลิงก์นี้ เส้นทางที่แท้จริงของไดเร็กทอรีนี้ 
	//จะถูกแนบไว้กับ URL แบบ Query String แล้วส่งกับเข้าไปในเพจนี้  
	//ซึ่งถ้าเราย้อนกลับไปดูในขั้นตอนก่อนนี้จะพบว่ามีการตรวจสอบตัวแปร $_GET['path']
	//ซึ่งตรงนี้เองทำให้พาธที่เราส่งกลับเข้าไปนี้ ถูกนำไปใช้ในการอ่านรายการไฟล์มาแสดง
	echo "<a href=\"$url?path=$realpath\">{$dirs[$i]}</a>";
}
?>
</section>
<article>
<table>
<tr>
  	<td>Name</td><td>Type</td><td>Size</td><td>Action</td>
</tr>
<?php
list_file("dir");  //แสดงรายการทีเป็น่ไดเร็กทอรีก่อน
list_file("file");	//ต่อไปแสดงรายการที่เป็นไฟล์

function list_file($type) {
	global $path;
	$dir = opendir($path);
	
	//อ่านไฟล์และไดเร็กทอรีทีละอันจากพาธที่กำหนด
	while($file = readdir($dir)) {
		$realpath = "$path/$file";   //เส้นทางที่แท้จริงไปยังไฟล์หรือไดเร็กทอรีที่อ่านได้ในลูปนี้
		
		//ปกติการอ่านด้วยฟังก์ชั่น readdir() จะได้ไดเร็กทอรีพิเศษเพิ่มมา 2 อันคือ . และ ..
		//ถึงแม้ในเราจะไม่ได้สร้างเอาไว้ก็ตาม แต่เราจะไม่นำ 2 ไดเร็กทอรีนี้มาแสดงด้วยจึงข้ามไป
		//นอกจากนี้ยังมีอีกกรณี เนื่องจากเราอ่านแยกกันทีละชนิดระหว่าง file และ dir 
		//ดังนั้นถ้าสิ่งที่เราอ่านได้ในลูปนี้ไม่ตรงกับชนิดที่ต้องการ ก็ให้ข้ามไปเช่นกัน
		//เช่น ต้องการเฉพาะชนิด dir แต่สิ่งที่อ่านได้ในลูปนี้เป็นชนิด file เป็นต้น
		$t = filetype($realpath);
		if($file == "." || $file == ".." || $type != $t) {
			continue;
		}
		
 		$img = "file.png";   //ภาพดีฟอลต์ที่ใช้แทนชนิดไฟล์ที่ไม่ได้เตรียมภาพเอาไว้
		$f = "";
		$filetype = "";
		$size = "";
		$action = "";
		
		if(is_dir($realpath)) {
			$img = "directory.png";  
			
			//ชื่อไดเร็กทอรี ให้ทำเป็นลิงก์  โดยแนบพาธของไดเร็กทอรีนั้นไว้กับ URL ของเพจนี้
			//เพื่อให้สามารถคลิกเปิดไดเร็กทอรีจากตรงนี้ได้อีกทางหนึ่ง
			$f = "<a href=\"$url?path=$realpath\">$file</a>";  
			$filetype = "directory";
			
			//สร้างลิงก์(ในรูปแบบปุ่ม)สำหรับเปิดไดเร็กทอรีนั้น ได้อีกทางหนึ่ง
			$action = "	<a href=\"$url?path=$realpath\" class=\"folder\">เปิดไดเร็กทอรี</a>"; 
			$action .= "<a href=\"#\" class=\"disabled\">ดาวน์โหลด</a>";   //ถ้าเป็นไดเร็กทอรีจะไม่ให้ดาวน์โหลด 
		}
		else if(is_file($realpath)) {
			$pathinfo = pathinfo($realpath);
			$ext = strtolower($pathinfo['extension']);	
			$filetype = $ext;		//ในที่นี้จะนำส่วนขยายของไฟล์มาเป็นชนิดไฟล์เลย
			
			//เราจะค้นดูว่าภาพที่เตรียมไว้ มีภาพใดที่ตรงกับชนิดของไฟล์หรือไม่
			if(file_exists("images/file-types/$ext.png")) {
				$img =  "$ext.png";
			}
						
			//ชื่อไฟล์ให้ทำเป็นลิงก์ เพื่อให้สามารถคลิกเปิดดูหรือแก้ไขจากตรงนี้ได้อีกทางหนึ่ง
			$f = "<a href=\"view-edit.php?path=$realpath\" target=\"_blank\">$file</a>";
			
			$size = filesize($realpath);
			if($size >= 1048576) {  //ถ้ามีขนาดตั้งแต่ 1048576 ขึ้นไปให้แปลงเป็นหน่วย MB
				$size = round($size/1048576, 2) . " MB";
			}
			else if($size >= 1024) { 	//ถ้ามีขนาดตั้งแต่ 1024 ขึ้นไปให้แปลงเป็นหน่วย KB
				$size = round($size/1024, 2) . " KB";
			}
			//สร้างลิงก์(ในรูปแบบปุ่ม)สำหรับเปิดดูและดาวน์โหลดไฟล์นั้น
			$action = "	<a href=\"view-edit.php?path=$realpath\" target=\"_blank\">เปิดแก้ไขไฟล์</a>";
			$action .= "<a href=\"download.php?path=$realpath\">ดาวน์โหลด</a>";	
		}
		
		//สร้างลิงก์(ในรูปแบบปุ่ม) สำหรับเปิดเพจเปลี่ยนชื่อและลบไฟล์หรือไดเร็กทอรีนั้น 
		$action .= "<a href=\"rename.php?path=$realpath\" target=\"_blank\">เปลี่ยนชื่อ</a>"; 
		$action .= "<a href=\"remove.php?path=$realpath\" target=\"_blank\">ลบ</a>";
		
		//นำข้อมูลที่สร้างไว้มาแสดงเป็นแถวของตาราง		
		echo "<tr>
					<td><img src=\"images/file-types/$img\">$f</td>
					<td>$filetype</td>	<td>$size</td><td>$action</td>
				</tr>";	
	}
	closedir($dir);
}

?>
</table>
</article>
</div>
<footer>
	&copy; <?php echo date('Y'); ?> - All Rights Reserved
</footer>
</body>
</html>