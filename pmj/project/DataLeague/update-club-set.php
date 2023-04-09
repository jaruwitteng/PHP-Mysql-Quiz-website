<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
	$league = $_POST['league'];
	$club = $_POST['club'];
	$logo = "";
	if(is_uploaded_file($_FILES['logo']['tmp_name']))  {
		if($_FILES['logo']['error'] == 0) {
			$filename = $_FILES['logo']['name'];
			$p = pathinfo($filename);
			$ext = $p['extension'];
			
			//กำหนดชื่อไฟล์ภาพโลโก้ใหม่ โดยให้ขึ้นต้นชื่อลีกตามด้วยวันเวลาที่โพสต์เข้ามา
			$logo = $league . date('YmdHis') . ".$ext"; 
		}
		move_uploaded_file($_FILES['logo']['tmp_name'], "images/logo-club/$logo");
	}
	//ย้ายไฟล์ภาพโลโก้ไปเก็บไว้ในไดเร็กทอรี
	$sql = "REPLACE INTO clubs VALUES('', '$league', '$club', '$logo', 0,0,0,0,0,0,0,0)";
	mysqli_query($link, $sql);

	@mysqli_close($link);
}
?>