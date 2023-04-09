<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 6-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	form > h3 {
		margin-top: 10px;
		font-weight: bold;
		color: brown;
		margin-bottom: 3px;		
	}
	.warning {
		background: wheat;
		border: solid 1px red;
		color: red;
		padding: 3px;
		margin: 3px;
	}
	li {
		margin-left: 15px;
	}
	select {
		margin: 3px;
		border-radius: 3px;
		background: #ffc;
		border: solid 1px gray;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 5px;
		padding: 1px 10px;
	}
	button:hover {
		background: aqua;
		color: red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
		$msg = "";
		$err = "";

		if($_POST['payment']) {
			$msg = "<b>วิธีชำระเงิน:</b> ";
			$payment = $_POST['payment'];
			
			if($payment == "credit") {
				$msg .= "บัตรเครดิต (" . $_POST['credit'] . ") <br>";
			}
			else if ($payment == "bank") {
				$msg .= "โอนผ่านธนาคาร (" . $_POST['bank'] . ") <br>";
			}
		}
		else {
			$err .= "<li>ไม่ได้เลือกวิธีชำระเงิน</li>";
		}
		
		if($_POST['delivery']) {
			$msg .= "<b>วิธีจัดส่ง:</b> " . $_POST['delivery'] . "<br>";
		}
		else {
			$err .= "<li>ไม่ได้เลือกวิธีจัดส่ง</li>";
		}		
		
		//จะแสดงข้อมูลนี้ก็ต่อเมื่อ มีตัวเลือกชนิด checkbox อันใดอันหนึ่งถูกเลือก
		if($_POST['search'] || $_POST['social'] || $_POST['email']) {
			$msg .= "<b>รู้จักเราทาง: </b>";
			if($_POST['search']) { $msg .= "<li>{$_POST['search']}</li>"; 	}
			if($_POST['social']) { $msg .= "<li>{$_POST['social']}</li>"; }
			if($_POST['email']) { $msg .= "<li>{$_POST['email']}</li>"; }
		}
		
		//ถ้าไม่มีข้อผิดพลาด ให้แสดงข้อมูล แล้วไม่ต้องแสดงฟอร์มอีก 
		if($err == "") {
			echo "<h4>ข้อมูลที่ท่านเลือกคือ:</h4>$msg";
			exit("</body></html>");
		}
		else {
			echo '<div class="warning"><b>ข้อผิดพลาด</b>' . $err . '</div>';
		}
}
?>
<form method="post">
	<h3>วิธีชำระเงิน *</h3>
 	<input type="radio" name="payment" value="credit">บัตรเครดิต
 	<select name="credit">
 		<option value="VISA">VISA</option>
 		<option value="MasterCard">MasterCard</option>
 	</select><br>

 	<input type="radio" name="payment" value="bank">โอนผ่านธนาคาร
 	<select name="bank">
 		<option value="กรุงเทพ">กรุงเทพ</option>
 		<option value="กสิกรไทย">กสิกรไทย</option>
 		<option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
 	</select>
               
 	<h3>วิธีจัดส่ง *</h3>
	<input type="radio" name="delivery" value="EMS">EMS
	<input type="radio" name="delivery" value="ลงทะเบียน">ลงทะเบียน
        
 	<h3>ท่านรู้จักเราทาง</h3>
	<input type="checkbox" name="search" value="Search Engine">Search Engine<br>
	<input type="checkbox" name="social" value="Social Media">Social Media<br>
	<input type="checkbox" name="email" value="Forward Email">Forward Mail<br><br>
 
	<button>ส่งข้อมูล</button>
</form>
</body>
</html>