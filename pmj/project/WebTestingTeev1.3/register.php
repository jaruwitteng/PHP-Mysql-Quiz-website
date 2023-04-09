<?php
session_start();
if($_POST) {
	//ตรวจสอบภาพ captcha
	/*
	if($_POST['captcha'] !== $_SESSION['captcha']) {
		echo "alert('Incorrect character from image');";
		exit;
	}
	*/
	//
	$login = $_POST['login'];
	$password = $_POST['pswd'];
	$fname =  $_POST['firstname'];
	$lname = $_POST['lastname'];
	$code = $_POST['code'];
	$err = "";
	
	include "dblink.php";
	
	//ตรวจสอบว่าว่า login และ code(รหัสประจำตัวซ้ำกับผู้อื่นหรือไม่)
	$sql = "SELECT login, code FROM testee WHERE login = '$login' OR code = '$code'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		if($login == $row[0]) {
			$err = "Login: $login is already taken please enter another one";
		}
		else if(!empty($row[1]) && ($code == $row[1])) {
			$err = "Code: $code is already redeemed please enter another one่";
		}
	}
	
	 if($err == "") {
		$sql = "INSERT INTO testee VALUES(
					'', '$login', MD5('$password'), '$fname', '$lname', '$code')";
		
		if(!mysqli_query($link, $sql)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	 }
	 
	 if($err != "") {
		echo "alert('$err');";
		mysqli_close($link);
		exit;
	 }
	 $_SESSION['user'] = "testee";
	 $_SESSION['testee'] = "$fname  $lname";
	$_SESSION['testee_id'] = mysqli_insert_id($link);
	echo "
		setInterval(function() { location.href = 'index.php'; }, 3000);
		$('form')[0].reset();
		alert('Registered returning to Home in 3 seconds');";
		
	mysqli_close($link);
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing</title>
<style>
	@import "global2.css";

	form {
		width: 600px;
		border: solid 0px green;
		border-radius: 8px;
		margin: 10px auto 15px;
		padding: 10px 0px;
		background: #cee;
	}
	form input {
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
	form img {
		margin-top: 5px;
		vertical-align: middle;
	}
	form div {
		text-align:center;
		margin-top: 10px;
	}
	form button {
		background: steelblue;
		color: white;
		border: solid 1px orange;
		padding: 3px;
		width: 80px;
		margin-right: 50px;
	}
	form button:hover {
		color: aqua;
		cursor: pointer;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('#ok').click(function(event) { 
		var error = false;
		$(':text, :password').each(function() {
            if($(this).attr('name') != "code") {
				if($(this).val().length == 0) {
					var t = $(this).prev('label').text();
					alert('Please fill in the following box\n' + t);
					error  = true;
					return false;
				}
			}
        });
		
		if(!error && ($(':password:first').val() !== $(':password:last').val())) {
			error  = true;
			alert('Incorrect Confirmed Password');
		}
		
		if(error) {
			return;
		}
		
		$.ajax({
			url: '<?php echo $_SERVER['PHP_SELF']; ?>',
			data: $('form').serializeArray(),
			dataType: "script",
			type: "post",
			beforeSend: function() {
				$('form').block({message: '<h2>กำลังส่งข้อมูล</h2>'});
			},
			complete: function() {
				$('form').unblock();
			}
		});
	});
	
	$('#cancel').click(function() {
		window.location = 'index.php';
	});
});
</script>
</head>
	
<body>
<div class="nav">
	<?php include "header.php"; ?>
	</div>
<div id="container">
<?php 
include "lib/AntiBotCaptcha/abcaptcha.php";
?>
<article>
<section id="top">
	<h3>Register</h3>
    <span>For those who will take the exam</span>
</section>
<section id="content">

<form method="post">
    <label>Login:</label><input type="text" name="login" required><br>
    <label>Password:</label><input type="password" name="pswd" required><br>
    <label>Confirm Password:</label><input type="password" name="pswd2" required><br>
	<br>
    <label>Name:</label><input type="text" name="firstname" required><br>
    <label>Surname:</label><input type="text" name="lastname" required><br>
    <label>Code(optional):</label><input type="text" name="code">
	<!--
    <br>
	

    <label></label><?php captcha_echo(); ?><br>
    <label>Type the characters above:</label><input type="text" name="captcha" required>
    <br>

	-->
    <div>
     	<button type="button" id="ok">Register</button>
        <a href="index.php">Cancel</a>
	</div>
</form>

</section>
</article>

</div>
</body>
</html>