<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 6-3</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	form {
		min-width: 320px;
	}
	form * {
		font: 14px tahoma;
	}
	form > div {
		float: left;
		margin: 2px;
	}
	input  {
		width: 150px;
	}
	textarea {
		width: 310px;
		height: 40px;
		resize: none;
		overflow: auto;
	}
	input, textarea {
		background: #ffc;
		border: solid 1px silver;
		border-radius: 3px;
		padding: 2px 3px;
		color: blue;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 5px;
		padding: 2px 10px;
	}
	button:hover {
		background: aqua;
		color: red;
	}
	.clear {
		clear: both;
	}
	.err {
		background: wheat;
		border: solid 1px red;
		color: red;
		padding: 3px;
		margin: 3px;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$login = $_POST['login'];
	$pswd = $_POST['password'];
	$info = $_POST['info'];
	$code = $_POST['code'];
	
	if($login != "" && $pswd != "" && $info != "") {
		echo "<h4>
					การสมัครสมาชิกเสร็จเรียบร้อย<br>
					ข้อมูลของท่านคือ:
				</h4>
				
				Login: $login <br>
				Password: $pswd <br>
				Personal Info: $info <br>
				Code: $code";
		
		exit("</body></html>");		//ถ้าข้อมูลถูกต้องก็ไม่ต้องแสดงฟอร์ม
	}
	else {
		echo '<p class="err">ท่านใส่ข้อมูลไม่ครบ</p>';
	}
}
?>
<h3>สมัครสมาชิก</h3>
<form method="post">
	<div>อีเมล(ล็อกอิน):<br>
    	<input type="text" name="login">
    </div>
    <div>รหัสผ่าน: <br>
     	<input type="password" name="password">
     </div>
    <br class="clear">
    <div>ข้อมูลส่วนตัว:<br>
    	<textarea name="info" cols="36" rows="2"></textarea>
    </div>
    <br class="clear">
    <div>
    	<input type="hidden" name="code" value="<?php echo mt_rand(); ?>">
    	<button>ตกลง</button>
    </div>
</form>
</body>
</html>