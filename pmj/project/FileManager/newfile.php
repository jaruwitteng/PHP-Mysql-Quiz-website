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
		padding: 10px 0px;
		text-align: center;
	}
	textarea {
		width: 98%;
		height: 350px;
		font-size: 11pt;
		resize: none;
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
		if(text == "บันทึกไฟล์") {
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
	<img src="images/new.png"><span>สร้างไฟล์ใหม่</span>
	<a href=#>ปิด</a>
</nav>
<article>';

	$path = $_POST['path'] .'/'. $_POST['filename'];
	$content = stripslashes($_POST['content']);
	if(@file_put_contents($path, $content)) {
		echo "<h2>บันทึกไฟล์เสร็จเรียบร้อย</h2>
				<script>window.opener.location.reload();</script>";
	}
	else {
		echo "<span class=\"error\">เกิดข้อผิดพลาดในการบันทึกไฟล์</span>
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
	<img src="images/new.png"><span>สร้างไฟล์ใหม่</span>
	<a href="#">ยกเลิก</a>
    <a href="#">บันทึกไฟล์</a>
</nav>
<form method="post">
<section id="breadcrumbs">
 	<?php echo dirname($_GET['path']); ?>/<input type="text" name="filename" placeholder="ชื่อไฟล์"> 
</section>
<article>
    <textarea name="content" placeholder="ใส่เนื้อหาของไฟล์ที่นี่"></textarea>
	<input type="hidden" name="path" value="<?php echo $_GET['path']; ?>">
</form>
</article>
</div>
</body>
</html>