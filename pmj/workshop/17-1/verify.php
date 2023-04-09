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
				
	$code = $_POST['code'];
	$email = $_POST['email'];
	$target = $_POST['target'];
	$err = "";
	$msg = "";
	
	//ถ้าเลือกการยืนยันรหัส
	if($target == "verify") {
		$sql = "UPDATE member SET verify = '' 
		 			WHERE  email = '$email' AND verify = '$code'";
					
	 	$rs = mysqli_query($link, $sql);
		
		//ถ้าเกิดการเปลี่ยนแปลง แสดงว่าใส่รหัสถูกต้อง
		if(mysqli_affected_rows($link) == 0) {
			$err = "ท่านใส่อีเมลหรือรหัสยืนยันไม่ถูกต้อง";
		}
		else {
			$msg = "การยืนยันของท่านเสร็จเรียบร้อยแล้ว";
		}
	}
	
	//ถ้าขอให้ส่งรหัสไปให้ใหม่
	else if($target == "re-code") {
		//กรณีนี้เราต้องอ่านรหัสจากตาราง แล้วส่งไปทางอีเมล
		$sql = "SELECT verify FROM member WHERE email = '$email'";
		$rs = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($rs);
		
		if(mysqli_num_rows($rs)==0) {  
			$err  = "ไม่พบอีเมลที่ท่านระบุ";		//ถ้าไม่มีข้อมูลแสดงว่าใส่อีเมลผิด
		}		
		else if(empty($data[0])) {
			$err = "ท่านยืนยันรหัสนี้ไปแล้ว";
		}
		else {
			$code = $data[0];
			ini_set("SMTP", "smtp.totisp.net");
			include "thaimailer.php";
			mail_from("admin<admin@example.com>");
			mail_to("<$email>");
			mail_subject("รหัสยืนยันการสมัครสมาชิก");
			mail_body("รหัสการยืนยันคือ: $code");
			if(mail_send()) {  //แม้ส่งสำเร็จ แต่ให้เหมือนกับเกิดข้อผิดพลาด
				$err = "ส่งรหัสการยืนยันไปทางอีเมลแล้ว";
			}
			else {
				$err = "เกิดข้อผิดพลาดในการส่งอีเมล";
			}
		}
	}

	if($err != "") {
		echo '<div>';
		echo "<h3 class=\"red\">$err</h3>";
		echo '</div>';
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
<h3>ยืนยันการสมัครสมาชิก</h3>
<form method="post">
		<input type="radio" name="target" value="verify" checked>ยืนยันการสมัคร
        <input type="radio" name="target" value="re-code">ขอรหัสใหม่(ใส่แค่อีเมลแล้วส่งข้อมูล) <br>
		<input type="text" name="email" placeholder="อีเมล" required><br>
        <input type="text" name="code" placeholder="รหัสยืนยันที่ได้รับทางอีเมล"><br>
      	<span>
     		<button>ส่งข้อมูล</button><br class="clear">
     	</span>
</form>
<p><a href="index.php">กลับหน้าหลัก</a></p>
</body>
</html>