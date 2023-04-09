<?php include "check-login.php";  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
</head>
<style>
	@import 'global.css';
	
	article {
		margin: auto;
		padding: 20px 0px;
		text-align: center;
	}
	span.warning {
		font-style: italic;
		color: brown;
		display: block;
		padding: 5px;
	}
	.target {
		color: red;
		font-weight: bold;
		padding: 2px;
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
if($_POST) {
	echo '
<nav>
	<img src="images/delete.png"><span>ลบไฟล์/ไดเร็กทอรี</span>
	<a href="#">ปิด</a>
</nav>
<article>';

	$path = $_POST['path'];
	
	if(is_dir($path)) {
		$rm = @rmdir($path);
	}
	else if(is_file($path)) {
		$rm = @unlink($path);
	}
	if($rm) {
		echo '<h2>การลบ เสร็จเรียบร้อย</h2>
				<script>window.opener.location.reload();</script>';
	}
	else {
		echo '<span class="error">เกิดข้อผิดพลาดในการลบ</span>';
	}

	echo '
</article>
</div></body></html>';

	exit;
}
?>

<!-- ################################################ -->
<nav>
	<img src="images/delete.png"><span>ลบไฟล์/ไดเร็กทอรี</span>
	<a href="#">ยกเลิก</a>
    <a href="#">ตกลง</a>
</nav>
<article>
<?php
$path = $_GET['path'];
$basename = basename($path);
$dirname = dirname($path);
?>
<form method="post">
	<?php echo $dirname.'/<span class="target">'.$basename.'</span>'; ?>
	  <input type="hidden" name="path" value="<?php echo $path; ?>">
      <br><br>
      <span class="warning">
      <b>คำเตือน:</b><br>
        	การลบไดเร็กทอรีที่ไม่ใช่ไดเร็กทอรีว่างจะไม่สามารถลบได้ ต้องลบไฟล์และไดเร็กทอรีย่อยทั้งหมดที่อยู่ภายในไดเร็กทอรีนั้นก่อน
      </span>
</form>
</article>
</div>
</body>
</html>