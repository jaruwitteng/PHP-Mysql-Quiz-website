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
	input[type=text] {
		font-size: 11pt;
		color: blue;
		background-color: #ffc;
		border: solid 1px silver;
	}
	h2, span.error {
		font-size: 16pt !important;
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
	<img src="images/edit.png"><span>เปลี่ยนชื่อไฟล์/ไดเร็กทอรี</span>
	<a href=#>ปิด</a>
</nav>
<article>';

	$path = $_POST['path'];
	$pathinfo = pathinfo($path);
	$newname = $pathinfo['dirname'] . "/" . $_POST['newname'];
	if(@rename($path, $newname)) {
		echo '<h2>การเปลี่ยนชื่อ เสร็จเรียบร้อย</h2>
				<script>window.opener.location.reload();</script>';
	}
	else {
		echo "<span class=\"error\">เกิดข้อผิดพลาดในการเปลี่ยนชื่อ</span><br><br>
				<a href=\"{$_SERVER['PHP_SELF']}?path=$path\">ย้อนกลับ</a>";
	}
	echo '
</article>
</div></body></html>';

	exit;
}
?>

<!-- ################################################ -->

<nav>
	<img src="images/edit.png"><span>เปลี่ยนชื่อไฟล์/ไดเร็กทอรี</span>
	<a href="#">ยกเลิก</a> <a href="#">ตกลง</a>
</nav>
<article>
<?php
$path = $_GET['path'];
$basename = basename($path);
$dirname = dirname($path);
?>
<form method="post">
		<?php echo $dirname; ?>/<input name="newname" type="text" value="<?php echo $basename; ?>" size="25">
        <input type="hidden" name="path" value="<?php echo $path; ?>">
</form>
</article>
</div>
</body>
</html>