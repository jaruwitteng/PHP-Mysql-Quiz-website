<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 15-1</title>
<style>
	*:not(h2) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	fieldset {
		width: 250px;
		text-align: left;
		margin: auto;
		border-radius: 3px;
	}
	h2 > img {
		vertical-align: middle;
		margin-right: 5px;
	}
	a {
		color: blue;
		text-decoration: none;
		float: right;
	}
	a:hover {
		color: red;
	}
	h2.red {
		color: #900;
	}
	h2.green {
		color: #060;
	}
</style>
</head>

<body>
<?php
//เมื่อเปิดเพจมา ให้ตรวจสอบเลยว่าได้เก็บข้อมูลการเข้าสู่ระบบไว้ในคุกกี้หรือไม่
//ถ้าเก็บไว้ ก็ให้สร้างเซสชั่นเพื่อเก็บข้อมูลเหมือนกับตอนนที่เราล็อกอินผ่านฟอร์ม
//เพื่อให้เข้าสู่ระบบโดยอัตโนมัติ
if(isset($_COOKIE['email']) && isset($_COOKIE['pswd'])) {
	$email = $_COOKIE['email'];
	$pswd = $_COOKIE['pswd'];
	if($email === "test@example.com" && $pswd === "abc456") {
		$_SESSION['email'] = $email;
	}
}

if(!isset($_SESSION['email'])) {   //ถ้าไม่มีข้อมูลในเซสชั่นแสดงว่ายังไม่เข้าสู่ระบบ
?>
	<fieldset>
    	<h2 class="red"><img src="error.png">ท่านยังไม่เข้าสู่ระบบ</h2>
     	<a href="login.php">เข้าสู่ระบบ</a>          
    </fieldset>
<?php
}
else {  //ถ้ามีข้อมูลในเซสชั่นแสดงว่าเข้าสู่ระบบแล้ว
?>
	<fieldset>
    	<h2 class="green"><img src="done.png">ท่านเข้าสู่ระบบแล้ว</h2>
     	<a href="logout.php">ออกจากระบบ</a>
     </fieldset>          
<?php
}
?>
</body>
</html>