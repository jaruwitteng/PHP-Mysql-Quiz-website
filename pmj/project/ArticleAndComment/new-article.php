<?php	
session_start();  
if(!isset($_SESSION['admin'])) {
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article & Comment</title>
<style>
	@import "global.css";
	form#new-article {
		width: 610px;
		margin: auto;
	}
	form#new-article * {
		margin: 3px;
	}
	form#new-article input[type=text], form#new-article textarea {
		font-size: 14px;
		padding: 3px;
		border: solid 1px gray;
		background: #eef;
	}
	form#new-article input[name=topic] {
		width: 590px;
	}
	form#new-article input[name=writer] {
		width: 230px;
	}
	form#new-article textarea {
		width: 590px;
		height: 150px;
		resize: none;
		overflow: auto;
	}
	form#new-article button {
		width: 80px;
		font-size: 14px;
	}
	form#new-article div {
		float: right;
		font-size: 14px !important;
		padding-top: 5px;
	}
	form#new-article span#select-image {
		float: right;
		margin-right: 10px;
	}
	h3.normal {
		color: green;
		text-align: center;
	}
	h3.warning {
		color: red;
		text-align: center;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.form.min.js"> </script>
<script>
$(function() {
	$(document).on('change', '#file', function() {
		if(this.files[0].size > 512000) {
			alert('ไฟล์ภาพมีขนาดใหญ่เกินกำหนด (500 KB) อาจมีปัญหาในการอัปโหลด กรุณาเปลี่ยนใหม่');
			//$(this).replaceWith($(this).clone());
			$('input:file').clearInputs();  //อยู่ในไลบรารี form.js
		}
	});
});
</script>
</head>
<body>
<?php  include "header-nav.php"; ?>
<div id="container">
<?php
include "logo-banner.php"; 
$page_title = "เพิ่มบทความใหม่";
include "breadcrumbs.php"; 
?>
<article>
<?php
if($_POST) {
	include "dblink.php";
	
	//ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
	//เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป (รายละเอียดอยู่ในบทที่ 14)
	$image_id = "";
	if(is_uploaded_file($_FILES['file']['tmp_name']))  {
		if($_FILES['file']['error'] == 0) {
			include "lib/IMager/imager.php";
			$img = image_upload('file');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, 600, 300); //ให้ภาพกว้างไม่เกิน 600px สูงไม่เกิน 300px
			$f = image_store_db($img, "image/jpeg");
			
			$sql = "REPLACE INTO image VALUES('', '$f')";
			mysqli_query($link, $sql);
			$image_id = mysqli_insert_id($link);
		}
	}
	
	$t = $_POST['topic'];
	$c = $_POST['content'];
	$w = $_POST['writer'];
	$ac = "yes";
	if($_POST['allow_comment']) {
		$ac = "no";
	}

	$sql = "REPLACE INTO article VALUES('', '$t', '$c', '$w', '$ac', NOW(), 0, '$image_id')";
	if(@mysqli_query($link, $sql)) {
		echo '<h3 class="normal">บันทึกข้อมูลเรียบร้อยแล้ว</h3>';
	}
	else {
		echo '<h3 class="waringing">เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่</h3>';
	}
}
else {
?>
<form id="new-article" method="post" enctype="multipart/form-data">
	<img src="images/cover-image.jpg" id="img"><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="512000"> 
	<input type="file" name="file" id="file" accept="image/*">
    <span id="select-image">[เลือกภาพประกอบบทความ]</span><br>
    <input type="text" name="topic" placeholder="หัวข้อ *" required><br>
    <textarea name="content" placeholder="เนื้อหา *" required></textarea><br>
    <input type="text" name="writer" placeholder="ชื่อผู้เขียน *"required>
    <button type="submit" id="submit">ส่งข้อมูล</button> 
    <div><input type="checkbox" name="allow_comment">ไม่ให้แสดงความคิดเห็นสำหรับบทความนี้</div>
</form>
<?php
}
?>
</article>

<?php include "aside.php"; ?>
<?php include "footer.php"; ?>
</div>
</body>
</html>
<?php @mysqli_close($link); ?>