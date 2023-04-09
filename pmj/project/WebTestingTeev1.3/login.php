<?php
session_start();

if($_POST) {
	$msg = "";
	$login = $_POST['login'];
	$password = $_POST['pswd'];
	$type = $_POST['type'];
	
	//ถ้าเป็นผู้ทดสอบ
	if($type == "tester") {
		if($login === "admin" && $password === "abc456") {
			$_SESSION['user'] = "tester";
			header("Location: index.php");
			exit;
		}
		else { 
			$msg = "Incorrect Login or Password";
		}
	}
	else if($type == "testee") {
		include "dblink.php";
		$sql = "SELECT testee_id, firstname, lastname FROM testee WHERE login = '$login' AND password = MD5('$password')";
		$result = mysqli_query($link, $sql);
		if(!$result) {
			$msg = "เกิดข้อผิดพลาด กรุณาลองใหม่";
		}
		else {
			$r = mysqli_num_rows($result);
			if($r == 1) {
				$row = mysqli_fetch_array($result);
				$_SESSION['user'] = "testee";
				$_SESSION['testee_id'] = $row[0];
				$_SESSION['testee_name'] = $row[1] . "  " . $row[2]; 
				
				mysqli_close($link);
				header("location: index.php");
				exit;
			}
			else {
				$msg = "ท่านกำหนด Login หรือ Password ไม่ถูกต้อง";
			}
		}
		mysqli_close($link);
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing</title>
<style>
	@import "./global2.css";
	form {
		
		width: 600px;
		border: solid 0px green;
		border-radius: 8px;
		margin: 10px auto 15px;
		padding: 10px 0px;
		background: #cee;
		box-shadow: 8px 8px 5px rgb(61, 108, 179)
	}
	form input:not([type=radio]) {
		width: 200px;
		background: #ffd;
		border: solid 1px gray;
		padding: 2px;
		color: blue;
	}
	form label {
		display: inline-block;
		width: 200px;
		text-align: right;
		padding: 5px;
	}
	form div {
		text-align:center;
		margin: 10px;
	}
	button {
		background: steelblue;
		color: white;
		border: solid 1px orange;
		padding: 3px;
		width: 100px;
		border-radius: 10px;
		
	}
	button:hover {
		color: aqua;
		cursor: pointer;
		transition: all 1s ease;
		box-shadow: 3px 3px 5px darkblue
	}
	h4.error {
		color: red;
		text-align: center;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('button').click(function() {
		if($(':text').val() == "")  {
			alert('Login required');
		}
		else if($(':password').val() == "") {
			alert('Password required');
		}
		else if($(':radio:checked').length == 0) {
			alert('User Type required');
		}
		else {
			$('form').submit();
		}
	});
});
</script>
<body>
	<div class="nav">
	<?php include "header.php"; ?>
	</div>
<div id="container">




<article>
<section id="top">
	<h3>Welcome to EXAMGURU</h3>
    
</section>
<section id="content">
<!--<?php  echo '<h4 class="error">'.$msg.'</h4>';   ?>-->
<form method="post">


    <label>Login:</label><input type="text" name="login" required><br>
    <label>Password:</label><input type="password" name="pswd" required><br>
    <label>User Type:</label>
     	<input type="radio" name="type" value="testee">Tester
        <input type="radio" name="type" value="tester">Examiner
       <br>
    <div><button type="button" id="ok">Enter</button><br><br>
    Create an account <a href="register.php">Register</a></div>
	
</form>
</section>
</article>



</div>
</html>