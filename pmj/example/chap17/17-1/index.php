<?php  ob_start();  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 17-1</title>
<style>  
	*:not(h2) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	form {
		display: inline-block;
		width: 340px;
		border: solid 1px gray;
		padding: 10px;	
		text-align: left;
		background: #cee;
		border-radius: 3px;
		margin-top: 10px;
	}
	img#abcaptcha {
		float: left;
		margin-right: 5px;
	}
	#status, input#captcha { 
	 	background: #ffc; 
	 	border: solid 1px #abc; 
	}
	#status { 
	 	width: 330px; 
		height: 50px;
		resize: none;
		overflow: auto;
	}
	input#captcha { 
	 	width: 150px; 
	}
 	.clear { 
		clear: left; 
	}
	div {
		text-align: center;
	}
</style>
</head>

<body>
<?php
session_start(); 
if($_POST) {
	if($_POST['captcha'] == $_SESSION['captcha']) {
		header("refresh: 2");
		exit("<h2>อัปเดตสถานะแล้ว</h2></body></html>");
	}
	else {
		echo "<h2>ท่านใส่อักขระไม่ตรงกับในภาพ</h2>";
	}
}
ob_end_flush();
 ?>
<form method="post">
 	อัปเดตสถานะ:<br>
	<textarea name="status" id="status"></textarea><br><br>
<?php
	include("../../../lib/AntiBotCaptcha/abcaptcha.php");
	captcha_bg_color("white");
	captcha_echo();
?>
	กรุณาใส่อักขระในภาพ:<br>
    <input type="text" name="captcha" id="captcha"><br  class="clear"><br>
    <div><button>ส่งข้อมูล</button></div>
</form>
</body>
</html>