<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 15-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	a {
		color: blue;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
	[type=email], [type=password] {
		width: 230px;
		background: #eee;
		border: solid 1px gray;
		padding: 3px;
		border-radius: 3px;
		margin: 3px 0px;
	}
	form#login > span {
		color: purple;
	}
	button {
		float: right;
		margin-right: 5px;
		margin-top: 10px;
		background: tomato;
		color: white;
		border-radius: 3px;
		border: solid 1px silver;
		padding: 2px 7px;
	}
	button:hover {
		background: yellow;
		color: red;	
	}
	fieldset {
		width: 240px;
		text-align: left;
		margin: auto;
		border-radius: 3px;
	}
	legend {
		font-size: larger;
		color: green;
	}
	a#index {
		display: inline-block;
		margin-top: 15px;
	}
	h3 {
		text-align: center;
	}
	h3.red {
		color: #900;
	}
	h3.green {
		color: #060;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$email = $_POST['email'];
	$pswd = $_POST['pswd'];
	
	if($email === "test@example.com" && $pswd === "abc456") {
		if($_POST['save_account']) {
			$expire = time() + 15 * 60;  //ให้คุกกี้มีอายุ 15 นาที
			setcookie('email', $email, $expire);
			setcookie('pswd', $pswd, $expire);
		}
		
		$_SESSION['email'] = $email;
		
		echo '<h3 class="green">ท่านเข้าสู่ระบบแล้ว จะกลับสู่หน้าหลักใน 3 วินาที</h3>';
		header("refresh: 3; url=index.php");
		exit('</body></html>');
		ob_end_flush();	
	}
	else {
		echo '<h3 class="red">ท่านใส่อีเมลหรือรหัสผ่านไม่ถูกต้อง</h3>';
	}
}
?>
 <fieldset><legend>สมาชิกเข้าสู่ระบบ</legend>
	<form id="login" method="post">
    	 <a href="#">สมัครสมาชิก</a> | <a href="#">ลืมรหัสผ่าน</a><br>
  		<input type="email" name="email" placeholder="อีเมล" required><br>
    	<input type="password" name="pswd" placeholder="รหัสผ่าน" pattern="^[a-zA-Z0-9]{5,15}$" required><br>
        <input type="checkbox" name="save_account">
        <span>เก็บข้อมูลไว้ในเครื่องนี้</span>
        <br>
    	<a href="index.php" id="index">หน้าหลัก</a>
        <button>เข้าสู่ระบบ</button>  
    </form>
</fieldset>
</body>
</html>
<?php ob_end_flush();  ?>