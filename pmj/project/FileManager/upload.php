<?php include "check-login.php";  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
<style>
	@import 'global.css';

	article {
		margin: auto;
		padding: 20px 0px;
		text-align: center;
	}
	ul {
		text-align: left !important;
	}
	table {
		margin: auto;
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
		if(text == "ตกลง") {
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
if($_FILES) {
	echo '
<nav>
	<img src="images/upload.png" height="30"><span>อัปโหลดไฟล์</span>
	<a href=#>ปิด</a>
</nav>
<article>';

	$url = $_SERVER['PHP_SELF'];
	$path = $_POST['path'];
	//ถ้าไฟล์นั้นมีข้อผิดพลาด ให้ข้ามไปยังไฟล์ถัดไป
	if($_FILES['file']['error'] == 0) {
		//ย้ายไฟล์ไปเก็บไว้ยังไดเร็กทอรีที่ถูกส่งขึ้นมา
		$dest = $path . "/" . $_FILES['file']['name'];
 	 	if(@move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
			echo '<h2>การอัปโหลด เสร็จเรียบร้อย</h2>
					<script>window.opener.location.reload();</script>';
		}
		else {
			echo '<span class="error">เกิดข้อผิดพลาดในการจัดเก็บไฟล์</span><br><br>
					<a href="'.$url.'?path='.$path.'">ย้อนกลับ</a>';
		}
	}
	else {
		switch($_FILES['file']['error']) {
			case 1: $msg = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; break;
			case 2: $msg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; break;
			case 3: $msg = "The uploaded file was only partially uploaded"; break;
			case 4: $msg = "No file was uploaded"; break;
			case 6: $msg = "Missing a temporary folder"; break;
			default: $msg = "Unknown upload error"; break;
		}
		echo '<span class="error">'.$msg.'</span><br><br>
				<a href="'.$url.'?path='.$path.'">ย้อนกลับ</a>';		
	}
	
	echo '
</article>
</div></body></html>';

	exit;
}
?>

<!-- ################################################ -->

<nav>
	<img src="images/upload.png"><span>อัปโหลดไฟล์</span>
	<a href="#">ยกเลิก</a>
    <a href="#">ตกลง</a>
</nav>
<section id="breadcrumbs"><?php echo $_GET['path']; ?></section>
<article>
<form method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
        <input type="file" name="file">
 		<input name="path" type="hidden" id="path" value="<?php echo $_GET['path']; ?>">
</form>
<table>
<tr><td>
<ul>
	<li>ไฟล์ที่อัปโหลดต้องมีขนาดไม่เกิน 5MB</li>
    <li>ใช้เวลาการอัปโหลดต้องไม่เกิน 30 วินาที</li>
</ul>
</td><td>
<ul>
    <li>ไฟล์จะถูกอัปโหลดไปยังไดเร็กทอรีที่เลือกในขณะนี้</li>
    <li>หากชื่อไฟล์ซ้ำซ้อนกัน ไฟล์เดิมจะถูกเขียนทับ</li>
</ul>
</td></tr>
</table>
</article>
</div>
</body>
</html>