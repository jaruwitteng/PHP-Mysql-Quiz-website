<?php  
session_start();
/*
	echo "alert('xxx');";
	if(is_uploaded_file($_FILES['photo']['tmp_name']))  {
		$error =  $_FILES['photo']['error'];
		echo "alert('yes');";
		if($error == 0) {
			
			include "lib/IMager/imager.php";
			$img = image_upload('photo');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, 120, 120); //ให้ภาพกว้างไม่เกิน 120px สูงไม่เกิน 120px
			$photo = image_store_db($img, "image/jpeg");
			echo "alert($img);";
		
		}
		else {
			echo "alert($error);";
		}
	}
	else {
		echo "alert('no')";
	}
	exit;
*/
if($_POST) {
	
	if($_SESSION['captcha'] != $_POST['captcha']) {
		echo "alert('ใส่อักขระในภาพไม่ถูกต้อง');";
		exit;
	}
	
	include "dblink.php";
		
	$name = $_POST['name'];
	$age = $_POST['age'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$expect_jobs = $_POST['expect_jobs'];
	$salary = $_POST['salary'];
	
	$lang = $_POST['lang'];
	$comp = $_POST['comp'];
	$other_skill = $_POST['other_skill'];
	$driving = "no";
	if($_POST['driving']) {
		$driving = "yes";
	}
	$license = "no";
	if($_POST['driving_license']) {
		$license = "yes";
	}
	$car = "no";
	if($_POST['own_car']) {
		$car = "yes";
	}	
	$sql = "REPLACE INTO resume VALUES(
				'', '$name', '$age','$address', '$phone', '$email', '$expect_jobs', '$salary', '$lang', '$comp', 
				'$other_skill', '$driving', '$license', '$car', NOW())";
	
	mysqli_query($link, $sql);
	$rid = mysqli_insert_id($link);
	
	//ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
	//เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป (รายละเอียดอยู่ในบทที่ 14)
	$photo = "";
	if(is_uploaded_file($_FILES['photo']['tmp_name']))  {
		$error =  $_FILES['photo']['error'];
		if($error == 0) {
			include "lib/IMager/imager.php";
			$img = image_upload('photo');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, 120, 120); //ให้ภาพกว้างไม่เกิน 120px สูงไม่เกิน 120px
			$photo = image_store_db($img, "image/jpeg");
		}
	}
	
	if($photo != "") {
		$sql = "REPLACE INTO image VALUE('$rid', '$photo')";
		mysqli_query($link, $sql);
	}
	
	for($i=0; $i < count($_POST['exp_position']); $i++) {
		$pos = $_POST['exp_position'][$i];
		$place = $_POST['exp_place'][$i];
		$period = $_POST['exp_period'][$i];
		
		$sql = "REPLACE INTO experience VALUES(
					'', '$rid', '$pos', '$place', '$period')";
		mysqli_query($link, $sql);
	}

	for($i=0; $i < count($_POST['edu_level']); $i++) {
		$level = $_POST['edu_level'][$i];
		$ac = $_POST['edu_academy'][$i];
		$major = $_POST['edu_major'][$i];
		$sql = "REPLACE INTO education VALUES(
					'', '$rid', '$level', '$ac', '$major')";
		mysqli_query($link, $sql);
	}
	
	mysqli_close($link);
	
	$_SESSION['resume_id'] = $rid;
	
	echo "
			var html = '<div style=\"text-align:center; margin:20px  0px;\">';
			html += '<h3>ข้อมูลของท่านถูกจัดเก็บแล้ว <br>หากข้อมูลของท่านผ่านการพิจารณา เราจะติดต่อกลับในภายหลัง</h3>';
			html += '<a href=\"show-resume.php\" target=\"_blank\">เปิดดู Resume</a>';
			html += '</div>';
			\$('article').html(html);";
			
}
?>