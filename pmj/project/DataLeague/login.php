<?php 
session_start();
ob_start();
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data League</title>
<style>
	@import "global.css";
	form {
		margin: 50px auto 50px;
		text-align: center;
	}
	input {
		background: #ffc;
		padding: 3px;
		border: solid 1px gray;
	}
	h4.err {
		text-align: center;
		color: red;
		margin-bottom: -20px;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script>
$(function() {
	$('#tabs').tabs({active: 0});
	$('#tabs').css('border', 'none');
});
</script>
</head>

<body>
<table id="container">
<caption id="header">Data League</caption>
<tr>
<td id="article">
<?php
	if($_POST) {
		$login = $_POST['login'];
		$pw = $_POST['pswd'];
		if(($login == "admin") && ($pw == "abc456")) {
			$_SESSION['admin'] = "admin";
			header("location: index.php");
			ob_end_flush();
			exit;
		}
		else {
 			echo '<h4 class="err">ท่านใส่ Login หรือ Password ไม่ถูกต้อง</h4>'; 
		}
	}
?>
	<form method="post">
    	<input type="text" name="login" placeholder="Login" required>
   	 	<input type="password" name="pswd" placeholder="Password" required>
    	<button>เข้าสู่ระบบ</button>
    </form>
</td>
<td id="aside">
<?php include "aside.php"; ?>
</td>
</tr>
<tr>
<td id="footer" class="text-center">
<?php include "footer.php"; ?>
</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>
<?php ob_end_flush(); ?>