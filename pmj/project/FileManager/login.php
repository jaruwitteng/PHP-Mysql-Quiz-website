<?php
session_start();
$err = "";
if($_POST) {
	if($_POST['login'] === "admin" && $_POST['pswd'] === "abc456") {
		$_SESSION['login'] = $_POST['login'];
		header("Location: index.php");
		exit;
	}
	else {
		$err = '<h4 class="err">ท่านใส่ Login หรือ Password ไม่ถูกต้อง</h4>';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
<style>
	@import "global.css";
	form {
		width: 350px;
		margin: auto;
		padding: 20px;
	}
	form label {
		display: inline-block;
		width: 100px;
		text-align: right;
	}
	input {
		font-size: 11pt;
		color: blue;
		border: solid 1px silver;
		margin: 3px;
	}
	h4.err {
		font-size: 16px !important;
		color: red;
		text-align: center;
		margin: 0px;
		padding-top: 10px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('a#login').click(function() {
			$('form').submit();
	});
});
</script>
</head>

<body>
<div id="container">
<header>
	<div id="logo">PHP File Manager</div>
</header>
<nav>
	<img src="images/login.png" height="30"><span>ผู้ดูแลระบบ</span>
    <a href="#" id="login">เข้าสู่ระบบ</a>
</nav>
<article>
<?php   echo $err;   ?>
 <form method="post">
 		<label>Login:</label><input type="text" name="login">
        <label>Password:</label><input type="password" name="pswd">
 </form>
</article>
</div>
<footer>
	© <?php echo date('Y'); ?> - All Rights Reserved
</footer>
</body>
</html>