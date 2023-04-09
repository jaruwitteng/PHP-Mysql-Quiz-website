<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 14-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		margin: 0px;
		min-width: 600px;
		text-align: center;
	}
	header {
		width: 100%;
		position: fixed;
		top: 0px;
		left: 0px;
		background: #444;
		height: 80px;
		z-index: 3000;
	}
	div#top, div#content, div#breadcrumb > section  {
		width: 600px;
		margin: auto;
	}
	nav {
		float: right;
		display: inline-block;
		height: 30px;
		text-align: left !important;
		padding: 5px 0px;
		margin-top: 1px;
	}
	div#breadcrumb {
		display: inline-block;
		margin: 10px auto 0px;
		width: 100%;
		height: 20px;
		background: url(bg2.jpg);
		text-align: left !important;
		padding: 5px 0px;
		border-bottom: solid 1px gray;
	}
	article {
		position: relative;
		top: 80px;
		margin: 20px auto 0px;
		width: 600px;
		text-align: left !important;
	}
	header h3 {
		float: left;
		font: normal 26px tahoma;
		color: aqua;
		margin: 5px 0px;
	}
	header span {
		font: normal 24px tahoma;
		color: aqua;
	}
	[type=text]  {
		width: 150px;
		background: #ffc;
		border: solid 1px aqua;
		border-right: none !important; 
		border-radius: 4px 0px 0px 4px; 
		margin-right: -3px;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px aqua;
		border-left: none !important; 
		border-radius: 0px 4px 4px 0px; 
		font-weight: bold;
		margin-left: -3px; 
		height: 28px;
	}
	button:hover {
		color: aqua;
	}
	a:hover {
		color: red;
	}
	br.clear {
		clear: right;
	}
	p#pagenum {
		text-align: center;
		margin: 10px;
	}
	nav a {
		display: inline-block;
		border-right: solid 1px silver;
		padding: 5px 15px 5px 10px;
		color: skyblue;
		text-decoration: none;
		font-size: 16px;
	}
	nav a:first-child {
		border-left: solid 1px silver;
		padding-left: 15px !important;
	}
	a:hover {
		color: red;
	}
	img.album-cover {
		width: 100px;
		height: 100px;
		border: solid 1px gray;
	}
	img.album-cover:hover {
		border-color: red;
	}
	a[href^="?a"] {
		display: inline-block;
		text-align: center;
		text-decoration: none;
		color: green;
		margin: 10px;
		background: #fc6;
		padding: 5px;
		max-width: 104px;
		overflow: hidden;
	}
	a[href^="?a"]:hover {
		color: red;
	}
</style>
</head>

<body>
<header>
<div id="top">
 		<h3>PHP Image Gallery</h3>
        <nav>
			<a href="?">Album</a>
			<a href="add-album.php">Add Album</a>
			<a href="add-image.php">Add Image</a>
		</nav>
</div>
<div id="breadcrumb">
	<section>
	<?php 
		echo "Album: ";
	 	if($_GET['a']) { 
	 		echo stripslashes($_GET['a']); 
		} 
		else { 
		 	echo "ทั้งหมด"; 
		} 
	?>
	</section>
</div>
</header>
<article>
<div id="content">
<?php
$album_folder = "album";
$img_types = array("jpg", "jpeg", "png", "gif");

//ถ้าไม่ได้แนบพารามิเตอร์ "a" ไว้กับ URL ก็ให้แสดงรายชื่ออัลบั้ม
if(!isset($_GET['a'])) {
	$d = opendir($album_folder);
	//ลูปนี้ใช้ตรวจสอบรายชื่อแต่ละอัลบั้มที่อยู่ในโฟลเดอร์ "album"
	while($album = readdir($d)) {
		$album_path = "$album_folder/$album";
		if($album == "." || $album == ".." || is_file($album)) {
			continue;
		}
		else {
			$d2 = opendir($album_path);
			//ลูปนี้จะเข้าอ่านภาพมาเป็นหน้าปก ถ้าเจอภาพแรกแล้ว ให้หยุดลูปนี้
			//เพื่อไปยังลูปของอัลบั้มถัดไปได้เลย
			while($file = readdir($d2)) {
				$f = "$album_path/$file";
				$ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
				if(in_array($ext, $img_types)) {
					echo "<a href=\"?a=$album\" title=\"$album\"><img src=\"$f\" class=\"album-cover\"><br>$album</a>";
					break;
				}
			}
			closedir($d2);
		}
	}
	closedir($d);
}
else {
	include "IMGallery/imgallery-jquery.php";
	$album = $_GET['a'];
	$album_path = "$album_folder/$album";
	gallery_echo_dir($album_path);
}
?>
</div>
</article>
</body>
</html>