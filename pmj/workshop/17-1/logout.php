<?php
session_start();
session_destroy();

//ลบคุกกี้การเข้าสู่ระบบ
$expire = time() - 3600;
setcookie('email', '', $expire);
setcookie('pswd', '', $expire);

//ให้ใช้เฮดเดอร์ refresh เพื่อหน่วงเวลาให้
//PHP สามารถส่งข้อมูลกลับมายังเบราเซอร์ได้
header("refresh: 3; url=index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
	body {
		cursor: wait;
		text-align: center;
	}
	h3.green {
		color: #060;
	}
</style>
<title>Workshop 17-1</title>
</head>

<body>
	<h3 class="green">ท่านออกจากระบบแล้ว จะกลับสู่หน้าหลักใน 3 วินาที</h3>
</body>
</html>