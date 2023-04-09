<?php
session_start();
ob_start();
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
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
</head>

<body><?php include "header-nav.php"; ?>
<div class="container">

<article>
	<section id="title">
     	<h3>เข้าสู่ระบบ</h3>
        <div></div>
	</section>
	<section id="content">
    <?php
	if($_POST) {
		$login = $_POST['login'];
		$pw = $_POST['pswd'];
		if(($login == "admin") && ($pw == "abc456")) {
			$_SESSION['user'] = "employer";
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
	</section>
</article>

<aside> <?php include "side-menu.php"; ?></aside>

<?php include "footer.php";  ?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>