<?php
if(is_uploaded_file($_FILES['file']['tmp_name'])) {
 	echo "<fieldset><legend>ไฟล์ที่อัปโหลด</legend>";
	echo "<span>ชื่อไฟล์:</span>".$_FILES['file']['name']."<br>";
	echo "<span>ชนิดไฟล์:</span>".$_FILES['file']['type']."<br>";	
	$size = ceil(($_FILES['file']['size']/1024));  //แปลงจากไบต์ให้เป็น KB
	echo "<span>ขนาดไฟล์:</span>$size KB";
 	echo "</fieldset>";
}
?>
