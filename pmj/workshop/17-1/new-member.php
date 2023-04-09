<?php session_start();  ?>
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
	input:not([type=checkbox])  {
		width: 305px;
		border: solid 1px gray;
		margin: 3px 10px;
		padding: 3px;
		border-radius: 3px;
	}
	[type=password] {
		width: 140px !important;
		margin-right: 2px !important;

	}
	[type=checkbox] {
		margin: 8px 5px 0px 0px;
		vertical-align: bottom;
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
	#abcaptcha {
		margin: 5px 0px 5px 10px;
		border-radius: 5px;
		vertical-align: middle;
	}
	[name=captcha] {
		width: 138px !important;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	include "dblink.php";
				
	$name = $_POST['name'];
	$email = $_POST['email'];	
	$pw1 = $_POST['pswd'];
	$pw2 = $_POST['pswd2'];
	
	$err = "";
	if($pw1 !== $pw2) {
		$err .= "<li>ใส่รหัสผ่านทั้งสองครั้งไม่ตรงกัน</li>";
	}
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$err .= "<li>อีเมลไม่ถูกต้องตามรูปแบบ</li>";
	}
	
	//ตรวจสอบว่าอีเมลนี้ใช้สมัครไปแล้วหรือยัง
	$sql = "SELECT COUNT(*) FROM member WHERE email = '$email'";
	$rs = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($rs);
	if($data[0] != 0) {
		$err  .= "<li>อีเมลนี้เป็นสมาชิกอยู่แล้ว</li>";
	}		
	
	if($_POST['captcha'] !== $_SESSION['captcha']) {
		$err .= "<li>ใส่อักขระไม่ตรงกับในภาพ</li>";
	}
	//ถ้ามีข้อผิดพลาดอะไรบ้าง ก็แสดงออกไปทั้งหมด
	if($err != "") {
		echo '<div>';
		echo '<h3 class="red">เกิดข้อผิดพลาดดังนี้คือ</h3>';
		echo "<ul class=\"red\">$err</ul>";
		echo '</div>';
	}
	else {	//ถ้าไม่มีข้อผิดพลาด
		$rand = mt_rand(100000, 999999);	  //verify code
		$sql = "INSERT INTO member VALUES(
					'', '$email', '$pw1', '$name', '$rand')";
	
		mysqli_query($link, $sql);
		
		//ส่งรหัสยืนยันไปทางอีเมล
		ini_set("SMTP", "smtp.totisp.net");
		include "thaimailer.php";
		mail_from("admin<admin@example.com>");
		mail_to("<$email>");
		mail_subject("รหัสยืนยันการสมัครสมาชิก");
		mail_body("รหัสการยืนยันคือ: $rand");
		@mail_send();
		
		echo "<h3>จัดเก็บข้อมูลของท่านเรียบร้อยแล้ว</h3><br>";
		echo "เราได้จัดส่งรหัสการยืนยันไปทางอีเมลที่ท่านใช้สมัครแล้ว<br>";
		echo 'กรุณานำรหัสดังกล่าวมายืนยันหลังจากล็อกอินเข้าสู่ระบบตามปกติ</a><br><br>';
		echo '<a href="index.php">กลับหน้าหลัก</a>';;
		mysqli_close($link);
		exit('</body></html>');
	}
	mysqli_close($link);
}
?>
<h3>สมัครสมาชิก</h3>
<form method="post">
		<input type="text" name="name" placeholder="ชื่อของท่าน" 
        	value="<?php echo stripslashes($_POST['name']); ?>" required><br>
		<input type="email" name="email" placeholder="อีเมล์ของท่านสำหรับเป็นล็อกอิน" 
         	value="<?php echo stripslashes($_POST['email']); ?>" required><br>
    	<input type="password" name="pswd" placeholder="รหัสผ่าน" required>
    	<input type="password" name="pswd2" placeholder="ใส่รหัสผ่านซ้ำ" required><br>
       <?php
	 	include "AntiBotCaptcha/abcaptcha.php";
		captcha_text_length(5);
		captcha_echo();
	 	?>
       <input type="text" name="captcha" placeholder="อักขระในภาพ" required>
      <br>
     <span>
     <label>
         <input type="checkbox" name="accept" required>ยอมรับเงื่อนไขของเว็บไซต์... 
      </label>
     <button>สมัครสมาชิก</button><br class="clear">
     </span>
</form>
<p><a href="index.php">กลับหน้าหลัก</a></p>
</body>
</html>