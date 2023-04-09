<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 16-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	input {
		width: 200px;
		background: #ddd;
		border: solid 1px gray;
		padding: 3px;
	}
	h3.green {
		color: green;
	}
	h3.red {
		color: red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	ini_set("SMTP", "smtp.totisp.net");
	include "../../../lib/thaimailer.php";
	
	$to = $_POST['email'];
	
	mail_from("Webmaster<webmaster@example.com>");
	mail_to("<$to>");
	mail_subject("รหัสผ่าน");
	mail_body("รหัสผ่านของท่านคือ: xxyy22", false);
	if(mail_send()) {
		echo "<h3 class=\"green\">เราส่งรหัสผ่านให้ท่านทางอีเมล $to เรียบร้อยแล้ว</h3>";
		exit("</body></html");
	}
	else {
		echo '<h3 class="red">การส่งเมลผิดพลาด กรุณาทดลองใหม่</h3>';
	}
}
?>
<form method="post">
	<h3>ใส่อีเมลที่ท่านใช้เป็น Login <br>
    รหัสผ่านจะถูกส่งไปที่อีเมลนี้</h3>
    <input type="email" name="email" required>
    <button>ส่งข้อมูล</button>
</form>
</body>
</html>