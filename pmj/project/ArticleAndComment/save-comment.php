<?php
session_start();
if($_POST) {
	if($_SESSION['captcha'] != $_POST['captcha']) {
		echo "alert('ใส่อักขระในภาพไม่ถูกต้อง');";
		exit;
	}
	else if($_POST['commentator']=="" || $_POST['comment_text'] == "") {
		echo "alert('ใส่ข้อมูลยังไม่ครบ');";
		exit;
	}
	include "dblink.php";
	
	//ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
	//เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป 
	$max_width = 500;
	if($_POST['comment_type'] == "r") {
		$max_width = 420;   //ถ้าเป็นการตอบกลับให้ภาพกว้างไม่เกิน 420
	}
	$image_id = "";
	if(is_uploaded_file($_FILES['file']['tmp_name']))  {
		if($_FILES['file']['error'] == 0) {
			include "lib/IMager/imager.php";
			$img = image_upload('file');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, $max_width, 300); 
			$f = image_store_db($img, "image/jpeg");
			
			$sql = "REPLACE INTO image VALUES('', '$f')";
			mysqli_query($link, $sql);
			$image_id = mysqli_insert_id($link);
		}
	}
	$id = $_POST['link_id'];
	$type = $_POST['comment_type'];
	$name = $_POST['commentator'];
	$text = $_POST['comment_text'];

	$sql = "REPLACE INTO comment VALUES('', '$id', '$type', '$text', '$name', NOW(), '$image_id')";
	if(@mysqli_query($link, $sql)) {
		echo "\$('#form-dialog').dialog('close'); 
				location.reload();";
	}
	else {
		echo "alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่')";
	}
	mysqli_close($link);
}
?>