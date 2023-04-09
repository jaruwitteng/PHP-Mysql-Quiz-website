<?php
include "check-login.php";

$path = "";
if($_GET['path'] && !$_POST['path']) {
	$path = $_GET['path'];
	$info = pathinfo($path);
	$ext = strtolower($info['extension']);
	
	$ext_txt = array("html", "htm", "php", "css", "js", "txt", "xml");	
	$ext_img = array("gif", "jpg", "jpeg", "png", "ico", "bmp", "swf");
	$ext_video_html5 = array("mp4", "webm", "ogg");
	$ext_audio_html5 = array("mp3", "wav", "ogg");
	
	//ถ้าเป็นชนิดไฟล์ที่ไม่สามารถเปิดผ่านเว็บได้ ให้เข้าสู่ขั้นตอนการดาวน์โหลดไฟล์นั้น
	if(!in_array($ext, $ext_txt) &&  !in_array($ext, $ext_img) && !in_array($ext, $ext_video_html5) && !in_array($ext, $ext_audio_html5)) {						
		header("Location:download.php?path=$path");
		exit;
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
<style>
	@import 'global.css';
	
	article {
		margin: auto;
		padding: 10px 0px;
		text-align: center;
	}
	span.warning {
		font-style: italic;
		color: brown;
		display: block;
		padding: 5px;
	}
	#panel {
		width: 98%;
		height: 400px;
		overflow: auto;
		text-align: center;
		margin: auto;
	}
	textarea {
		width: 98%;
		height: 400px;
		font-size: 11pt;
		resize: none; 
	}
	h2, span.error {
		font-size: 18pt !important;
	}
	span.error {
		color: red;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('nav a').click(function() {
		var text = $(this).text();
		if(text == "บันทึกการเปลี่ยนแปลง") {
			$('form').submit();
		}
		else if(text == "ยกเลิก" || text == "ปิด") {
			window.close();
		}
	});
});
</script>
</head>

<body>
<div id="container">
<header>
	<div id="logo">PHP File Manager</div>
</header> 
<?php
if($_POST) {
	echo '
<nav>
		<img src="images/search.png"><span>เปิด/แก้ไขไฟล์</span>
		<a href="#">ปิด</a>
</nav>
<section id="breadcrumbs">'.$path.'</section>
<article>';

	$path = $_POST['path'];
	$content = stripslashes($_POST['content']);
	if(@file_put_contents($path, $content)) {
		echo "<h2>บันทึกไฟล์เสร็จเรียบร้อย</h2>";
	}
	else {
		echo "<span class=\"error\">เกิดข้อผิดพลาดในการบันทึกไฟล์</span>
				<a href=\"{$_SERVER['PHP_SELF']}?path=$path\">ย้อนกลับ</a>";
	}
	
	echo '
</article>
</div></body></html>';

	exit;
}
?>		

<!-- ################################################ -->

<?php
if(in_array($ext, $ext_txt)) {	//ถ้าเป็น Text File
	echo '
<nav>
	<img src="images/search.png"><span>เปิด/แก้ไขไฟล์</span>
	<a href="#">ยกเลิก</a>
    <a href="download.php?path='.$path.'">ดาวน์โหลดไฟล์นี้</a>
	<a href="#">บันทึกการเปลี่ยนแปลง</a>
</nav>
<section id="breadcrumbs">'.$path.'</section>
<article>  
<form method="post">
    <textarea name="content">'. str_ireplace("</textarea>", "&lt;/textarea&gt;", file_get_contents($path)) .'</textarea>
 	<input type="hidden" name="path" value="'.$path.'">
</form>';
}
else {		//ถ้าเป็นอื่นๆที่สามารเปิดบนเว็บได้ เช่น รูปภาพ  วิดีโอ หรือเสียง
	echo '
<nav>
	<img src="images/search.png"><span>เปิด/แก้ไขไฟล์</span>
	<a href="#">ยกเลิก</a>
    <a href="download.php?path='.$path.'">ดาวน์โหลดไฟล์นี้</a>
</nav>
<section id="breadcrumbs">'.$path.'</section>
<article> 
<div id="panel">';

	$host =  $_SERVER['HTTP_HOST'];
	$root = $_SERVER['DOCUMENT_ROOT'];
	$src = "http://" . str_ireplace($root, $host, $path);
	
	if($ext == "swf") {		//ถ้าเป็น Flash
 		echo "<object>
	 				<param name=\"movie\" value=\"$src\">
	 				<embed src=\"$src\"></embed>
 				</object>";
	}
	else if(in_array($ext, $ext_img)) {
		echo "<img src=\"$src\">";
	}
	else if(in_array($ext, $ext_video_html5)) {
		echo "<video src=\"$src\" controls> </video>";
	}
	else if(in_array($ext, $ext_audio_html5)) {
		echo "<audio src=\"$src\" controls> </audio>";
	}
	
	echo '
</div>
</article>';
}
?>
</div>
</body>
</html>