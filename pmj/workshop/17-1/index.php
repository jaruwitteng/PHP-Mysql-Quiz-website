<?php 
session_start(); 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 17-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin: 0px;
	}
	h1 {
		color: steelblue;
		font-size: 20px !important;
		margin: 10px;
	}
	aside {
		position: fixed;
		top: 0px;
		left: 0px;
		width: 200px;
		height: 100%;
		background: steelblue;
	}
	article {
		position: absolute;
		left: 200px;
		top: 0px;
		min-width: 250px;
	}	
	section#top {
		margin-top: 20px;
	}
	section#bottom {
		text-align: center;
		position: fixed;
		bottom: 20px;
		left: 5px;
		color:lightgray;
	}
	aside > h1 {
		color: yellow !important;
	}
	a {
		color: aqua;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
	fieldset * {
		font-size: 12px !important;
	}
	fieldset {
		width: 160px;
		text-align: left;
		margin: auto;
		border-radius: 3px;
		font-size: 12px !important;
		color: white;		
	}
	legend {
		color: yellow;
	}
	form#login {
		color: white;
	}
	form#login > span {
		color: whitesmoke;
	}
	[type=email], [type=password] {
		width: 150px;
		background: #ffc;
		border: solid 1px gray;
		padding: 3px;
		border-radius: 3px;
		margin: 3px 0px;
	}
	button {
		float: right;
		margin-right: 5px;
		margin-top: 10px;
		background: tomato;
		color: cyan;
		border-radius: 3px;
		border: solid 1px aqua;
		padding: 2px 7px;
	}
	button:hover {
		background: yellow;
		color: red;	
	}
	a#forget {
		display: inline-block;
		margin-top: 15px;
	}
	span.err {
		display: inline-block;
		font-size: 14px;
		color: red;
		background: yellow;
		padding: 5px;
		margin-bottom: 5px;
	}
</style>
</head>

<body>
<?php
include "dblink.php";

//ตรวจสอบว่าเก็บข้อมูลการเข้าสู่ระบบไว้ในคุกกี้ หรือไม่
//ถ้ามี ให้กำหนดให้ตัวแปรได้เลย เพื่อให้เทียบเท่ากับการโพสต์ขั้นมาจากฟอร์ม
if(isset($_COOKIE['email']) && isset($_COOKIE['pswd'])) {
	$_POST['email'] = $_COOKIE['email'];
	$_POST['pswd'] = $_COOKIE['pswd'];
}

if($_POST) {
	$email = $_POST['email'];
	$pswd = $_POST['pswd'];

	$sql = "SELECT * FROM member  
		 		WHERE  email = '$email' AND password = '$pswd'";
	
	$rs = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($rs);
	if(mysqli_num_rows($rs) == 0) {
		$err  = '<span class="err">ท่านใส่อีเมล<br>หรือรหัสผ่านไม่ถูกต้อง</span>';
	}	
	else {
		if(!empty($data['verify'])) {
			mysqli_close($link);
			header("location: verify.php");
			ob_end_flush();
			exit;
		}
		
		if($_POST['save_account']) {
			$expire = time() + 30*24*60*60;
			setcookie("email", "$email");
			setcookie("pswd", "$pswd");
		}
		
		 $_SESSION['user'] = $data['name'];
		 $_SESSION['email'] = $data['email'];
	}
}
mysqli_close($link);
?>
<aside>
	<h1>DeveloperThai.com</h1>
	<section id="top">
<?php 
	 if(!isset($_SESSION['user'])) {  
?>
    <?php echo $err; ?>
   	<fieldset><legend>สมาชิกเข้าสู่ระบบ</legend>
	<form id="login" method="post">
    	 <a href="new-member.php">สมัครสมาชิก</a> |
         <a href="verify.php">ยืนยันการสมัคร</a><br>
  		<input type="email" name="email" placeholder="อีเมล" required><br>
    	<input type="password" name="pswd" placeholder="รหัสผ่าน" required><br>
        <input type="checkbox" name="save_account">
        <span>เก็บข้อมูลไว้ในเครื่องนี้</span><br>
         <a href="forget-password.php" id="forget">ลืมรหัสผ่าน</a> 
    	<button>เข้าสู่ระบบ</button>  
    </form>
    </fieldset>
 <?php  
 	}
 	else {
?>
	<fieldset><legend>ท่านเข้าสู่ระบบแล้ว</legend>
    	<?php echo $_SESSION['user']; ?><br><br>
    	<a href="logout">ออกจากระบบ</a>
	</fieldset>
<?php
	}
?>
	</section>
    <section id="bottom">
    <a href="admin.php">Administrator Login</a>
    </section>
</aside>
<article>
	<h1>ระบบข้อมูล<br>การสมัครสมาชิก</h1>
</article>
</body>
</html>
<?php ob_end_flush(); ?>