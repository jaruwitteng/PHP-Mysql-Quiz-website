<?php 
session_start(); 
$msg = "";
if($_POST) {
	if($_POST['login'] == "admin" && $_POST['pswd'] == "abc456") {
		$_SESSION['admin'] = 1;
		header("location:index.php");
		exit;
	}
	else {
		$msg = "ใส่ล็อกอินหรือรหัสผ่านไม่ถูกต้อง";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Poll & Vote</title>
<style>
	@import "global.css";
	form {
		width: 300px;
		text-align: left;
		margin: 30px auto;
		background: #bcb;
	}
	div {
		background: #dd9;
		padding: 3px 0px;
	}
	div#top {
		border-bottom: solid 1px #999;
		font-size: 16px;
		color: green;
		margin-bottom: 20px;
		padding: 5px;
	}
	div#bottom {
		display: inline-block;
		border-top: solid 1px #999;
		margin-top: 20px;
		width: 100%;
		padding: 5px 0px;
	}
	input {
		width:260px;
		margin: 3px 3px 3px 20px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
	}
	button#submit {
		margin-left: 10px;
	}
	br.clear {
		clear: right;
	}
	button:hover {
		color: aqua;
	}
	h3.err {
		text-align: center;
		color: red;
	}
	div#bottom a {
		float: right;
		margin: 3px 10px 0px 0px;
	}
</style>
</head>

<body>
<table id="container">
<tr><td colspan="3" id="header"><h1>DeveloperThai.com</h1></td></tr>
<tr>
	<td id="left-side">&nbsp;</td>
    <td id="content">
    <h3 class="err"><?php echo $msg; ?></h3>    
	<form method="post">
		<div id="top">เข้าสู่ระบบ</div>
    		<input type="text" name="login" placeholder="ล็อกอิน"> 
   			<input type="password" name="pswd" placeholder="รหัสผ่าน">
		<div id="bottom">
         	<button id="submit">ตกลง</button>
			<a href="index.php">หน้าหลัก</a>
            <br class="clear">
		</div>
	</form>    
    </td>
    <td id="right-side">&nbsp;
 	
    </td>
</tr>
</table>
</body>
</html>