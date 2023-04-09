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
	<img src="images/add-folder.png"><span>สร้างไดเร็กทอรีใหม่</span>
	<a href=#>ปิด</a>
</nav>
<article>';

	$path = $_POST['path'];
	$name = $_POST['dirname'];
	if(@mkdir($path . "/" . $name)) {
		echo '<h2>การสร้างโฟลเดอร์ เสร็จเรียบร้อย</h2>
				<script>window.opener.location.reload();</script>';
	}
	else {
		echo "<span class=\"error\">เกิดข้อผิดพลาดในการสร้างโฟลเดอร์</span><br><br>
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
	<img src="images/add-folder.png"><span>สร้างไดเร็กทอรีใหม่</span>
	<a href="#">ยกเลิก</a>
    <a href="#">ตกลง</a>
</nav>
<article>
<form method="post">
	  <?php 	echo dirname($_GET['path']) ."/";    ?><input type="text" name="dirname" placeholder="ชื่อไดเร็กทอรี">
	  <input  type="hidden" name="path" value="<?php echo $_GET['path']; ?>">
</form>
</article>
</div>
</body>
</html>