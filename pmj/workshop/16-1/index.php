<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 16-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	fieldset {
		display: inline-block;
		width: auto;
		background: #cfe3ed;
		border-radius: 4px;
	}
	legend {
		text-align: left;
		font-size: larger;
		color: navy;
	}
	form {
		text-align: left;
		padding: 10px;
	}
	[type=text], [type=email], textarea {
		width: 350px;
		background: #fff;
		border: solid 1px gray;
		padding: 2px;
		margin: 3px 0px;
	}
	[type=file] {
		margin: 3px 0px;
	}
	textarea {
		height: 100px;
		resize:none;
		overflow: auto;
	}
	button {
		float: right;
	}
	h3.green {
		color: green;
	}
	h3.red {
		color:red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	ini_set("SMTP", "smtp.totisp.net");
	include "thaimailer.php";
	
	$from = $_POST['name']."<".$_POST['from'].">";
	mail_from($from);
	
	//ผู้รับเมล ให้กำหนดแออดเดรสของเราเอง เพื่อให้เปิดดูได้
	mail_to("<banchar_pa@hotmail.com>"); 
	
	mail_subject(stripslashes($_POST['subject']));
	mail_body(stripslashes($_POST['body']), true);
		
	if(is_uploaded_file($_FILES['file']['tmp_name'])) {
		if($_FILES['file']['error'] == 0) {
			mail_attach($_FILES['file']['tmp_name']); 
		}
	}
	if(mail_send()) {
		echo '<h3 class="green">ข้อมูลการติดต่อของท่านถูกส่งออกไปแล้ว</h3>';
	}
	else {
		echo '<h3 class="red">การส่งข้อมูลล้มเหลว</h3>';
	}
}
?>
<fieldset><legend>ติดต่อเรา - Contact Us</legend>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="ชื่อของท่าน *" required><br>
 	<input type="email" name="from" placeholder="อีเมลของท่าน *" required><br>
    <input type="text" name="subject" placeholder="หัวข้อการติดต่อ *" required><br>
    <textarea name="body" placeholder="รายละเอียดการติดต่อ *" required></textarea><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="50000">
    <input type="file" name="file"><br>
    <hr>เราจะติดต่อกลับโดยเร็วที่สุด
    <button>ส่งข้อมูล</button>
</form>
</fieldset>
</body>
</html>