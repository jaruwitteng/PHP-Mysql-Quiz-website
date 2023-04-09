<?php ob_start();  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
if(!isset($_SERVER['PHP_AUTH_USER'])) {
 	 //ถ้าไม่ใช่การส่งข้อมูลกลับเข้ามา ให้แสดง  Prompt
 	header('WWW-Authenticate: Basic realm="My Realm"');
    	header('HTTP/1.0 401 Unauthorized');
	//ถ้าผู้ใช้คลิกปุ่ม Cancel(ยกเลิก) ให้ส่งข้อมูลนี้กลับไป พร้อมหยุดการทำงานของเพจ
 	exit("<html><body>กรุณาใส่ Login และ Password</body></html>");
}
else {		//ถ้าเป็นการส่งข้อมูลกลับเข้ามา
 	//...
}
?>
</body>
</html>
<?php ob_end_flush();  ?>