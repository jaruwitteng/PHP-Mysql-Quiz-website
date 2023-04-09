<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 7-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		margin-top: 20px;
		text-align: center;
		background: url(bg.jpg);
	}
	form {
		display: inline-block;
		width: 350px;
		background: #dff;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 5px;
	}
	input {
		width: 250px;
		background: #ffc;
		border: solid 1px gray;
		padding: 2px;
		border-radius: 3px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 2px 10px;
		float: right;
		margin: 10px;
	}
	label {
		display: inline-block;
		width: 80px;
		padding-top: 7px;
		font-size: 16px !important;
		text-align: left;
	}
	div {
		width: 350px;
		text-align: left !important;
		margin: auto;
	}
	h3 {
		margin: 2px;
		color: red;
	}
	ul {
		padding-left: 20px;
	}
	li {
		color: red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$mobile = $_POST['mobile'];
	
	$err = "";
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$err .= "<li>อีเมลไม่ตรงตามรูปแบบ</li>";
	}
	
	$pswd_pattern = "/^[a-z0-9]{5,15}$/i";
	if(!preg_match($pswd_pattern, $password)) {
		$err .= "<li>รหัสผ่านต้องประกอบด้วยตัวอักษร a-z หรือ A-Z หรือ 0-9 จำนวน 5-15 ตัว</li>";
	}
	
	$mobile_pattern = "/^0[89]{1}[0-9]{8}$/";
	if(!preg_match($mobile_pattern, $mobile)) {
		$err .= "<li>เบอร์มือถือไม่ตรงตามรูปแบบ</li>";
	}
	
	if($err != "") {
		echo "<div><h3>ข้อผิดพลาด</h3><ul>$err</ul></div>";
	}
}
?>
<form method="post">
	<label>อีเมล</label><input type="email" name="email" placeholder="สำหรับเป็น login" required ><br>
    <label>รหัสผ่าน</label><input type="password" name="password" placeholder="a-z หรือ A-Z หรือ 0-9 จำนวน 5-15 ตัว" required><br>
    <label>มือถือ</label><input type="tel" name="mobile" placeholder="0[8-9]xxxxxxxx แค่เบอร์เดียว" required><br>
    <button>ส่งข้อมูล</button>
</form>
</body>
</html>