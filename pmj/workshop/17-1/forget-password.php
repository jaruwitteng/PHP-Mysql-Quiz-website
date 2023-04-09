<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 17-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
	}
	form {
		display: inline-block;
		margin: auto;
		border: solid 1px gray;
		background: powderblue;
		text-align: left;
		border-radius: 3px;
		padding-top: 10px
	}
	form > span {
		display: inline-block;
		padding: 3px 0px;
		background: #69c;
		width: 100%;
		margin-top: 5px;
		text-align: left;	
	}
	form > span > label {
		display: inline-block;
		margin: 0px 10px;
		color: white;
	}
	input:not([type=radio])  {
		width: 350px;
		border: solid 1px gray;
		margin: 3px 10px;
		padding: 3px;
		border-radius: 3px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px silver;
		border-radius: 4px; 
		font-weight: bold;
		margin-right: 10px; 
		float: right;
		padding: 2px 5px;
	}
	button:hover {
		color: aqua;
	}
	a:hover {
		color: red;
	}
	h3 {
		margin: 3px;
	}
	div {
		width: 300px;
		display: inline-block;
		text-align: left !important;
	}
	.red {
		color: red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	include "dblink.php";
	$email = $_POST['email'];
	$err = "";
	$msg = "";
	
	$sql = "SELECT password FROM member WHERE email = '$email'";
	$rs = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($rs);
	if(mysqli_num_rows($rs)) {  
		$err  = "ไม่พบอีเมลที่ท่านระบุ";	
	}			
	else {
		$pswd = $data[0];
		ini_set("SMTP", "smtp.totisp.net");
		include "thaimailer.php";
		mail_from("Admin<webmaster@developerthai.com>");
		mail_to("<$email>");
		mail_subject("รหัสผ่าน");
		mail_body("รหัสผ่านของท่านคือ: $pswd");
		if(mail_send()) {  
			$msg = "ส่งรหัสผ่านไปทางอีเมลแล้ว";
		}
		else {
			$err = "เกิดข้อผิดพลาดในการส่งอีเมล";
		}
	}

	if($err != "") {
		echo "<div><h3 class=\"red\">$err</h3></div>";
	}
	else if($msg != "") {
		echo "<h3>$msg</h3><br>";
		echo '<a href="index.php">กลับหน้าหลัก</a>';
		mysqli_close($link);
		exit('</body></html>');
	}
	mysqli_close($link);
}
?>
<h3>ลืมรหัสผ่าน</h3>
<form method="post">
		<input type="text" name="email" placeholder="อีเมลที่ท่านใช้สมัครสมาชิก" required><br>
      	<span>
     		<button>ส่งข้อมูล</button><br class="clear">
     	</span>
</form>
<p><a href="index.php">กลับหน้าหลัก</a></p>
</body>
</html>