<?php
sleep(1);
include "check-login.php";
if(!$_FILES) { 	
	exit;
}

include "dblink.php";
if(is_uploaded_file($_FILES['file']['tmp_name']))  {
	$error =  $_FILES['file']['error'];
	if($error == 0) {
		include "lib/IMager/imager.php";
		$img = image_upload('file');
		$img = image_to_jpg($img);
		//$img = image_resize_max($img, 300, 300); 
		$file = image_store_db($img, "image/jpeg");
			
		$pro_id = $_SESSION['pro_id'];
		$sql = "REPLACE INTO images VALUES('', '$pro_id', '$file')";
		mysqli_query($link, $sql);
	}
}

mysqli_close($link);
?>