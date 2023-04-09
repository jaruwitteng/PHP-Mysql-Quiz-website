<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
<style>
	@import "global-order.css";
	#head {
		padding: 5px !important;
	}
	h3 {
		text-align: center;
		color: navy;
	}
	form {
		width: 80%;
		margin: 20px auto;
		font-size: 12px;
		color: green;
	}
	form > *:not(br) {
		font: 14px tahoma;
		margin: 3px;
		background: #ffc;
		border: solid 1px gray;
		padding: 3px;
	}
	[name=order_id], [name=email], [name=pswd],[name=phone] {
		width: 318px;
	}
	[name=hour], [name=min] {
		width: 66px;
	}
	[name=bank] {
		width: 158px;
	}
	[name=location], [name=date], [name= bath], [name=satang] {
		width: 150px;
	}	
	form input:first-child {
		margin-top: 10px;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script>
$(function() {
	$('[name=date]').datepicker({dateFormat: 'yy/mm/dd'});
	
	$('button#submit').click(function() {
		if($('[name=bank] option:selected').index() == 0) {
			alert('กรุณาเลือกธนาคาร');
			return false;
		}
		$('button[type=submit]').click();
	});

	$('button#index').click(function() {
		location.href = "index.php";
	});
	
});
</script>
</head>
<body>
<div id="container">
<h5><img src="images/logo2.gif" class="logo2"></h5>
<div id="head"><img src="images/megaphone.png">แจ้งการโอนเงิน</div>
<div id="content">
<?php
$err = "";
if($_POST) {
	include "dblink.php";
	$email = $_POST['email'];
	$pswd = $_POST['pswd'];
 	$sql = "SELECT cust_id FROM customers WHERE email = '$email' AND password = '$pswd'";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	if(mysqli_num_rows($r)==1) {
		$cust_id = $row[0];
		
		$order_id = $_POST['order_id'];
		$sql = "SELECT COUNT(*) FROM orders WHERE order_id = '$order_id' AND cust_id = '$cust_id'";
		$r = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($r);
		$c = $row[0];
		if($c == 1) {
			$bank = $_POST['bank'];
			$location =  $_POST['location'];
			$bath = $_POST['bath'];
			$satang = $_POST['satang'];
			if(!empty($satang)) {
				$bath .= ".$satang";
			}
			else {
				$bath .= ".00";
			}
			$h = $_POST['hour'];
			$m = $_POST['min'];
			$dt = $_POST['date'] . " $h:$m";
			$sql = "INSERT INTO payments VALUES(
						'', '$order_id', '$cust_id', '$bank', '$location', '$bath', '$dt', 'no')";
			if(!mysqli_query($link, $sql)) {
				$err = "ไม่สามารถบันทึกข้อมูล กรุณาตรวจสอบการใส่ข้อมูลของท่าน";
			}
			else {
				echo "<h2>เราจัดเก็บข้อมูลการโอนเงินของท่านแล้ว<br>
				 		และจะทำการตรวจสอบในลำดับต่อไป<br>
						ขอบคุณค่ะ</h2>";
			}
		}
		else {
			$err = "ไม่พบรหัสการสั่งซื้อ: $order_id";
		}
	}
	else {
		$err = "ท่านใส่อีเมลหรือรหัสผ่านไม่ถูกต้อง";
	}
	
	if($err != "") {
		echo '<h2 class="warning">'. $err . "</h2>";
	}
	mysqli_close($link);
}
if(!$_POST || $err != "") {
?>	
<form method="post">
	กรุณาใส่ข้อมูลให้ครบสมบูรณ์ เพื่อป้องกันข้อผิดพลาดในการตรวจสอบ
    <input type="email" name="email" placeholder="อีเมล *" required> อีเมล ที่ท่านใช้ในการสั่งซื้อ <br>
    <input type="password" name="pswd" placeholder="รหัสผ่าน *" required> รหัสผ่าน ที่ท่านใช้ในการสั่งซื้อ <br>
    <input type="text" name="order_id" placeholder="รหัสการสั่งซื้อ *" required> รหัสการสั่งซื้อ ที่ท่านได้รับทางอีเมล<br>
    <select name="bank">
    	<option>โอนผ่านธนาคาร *</option>
        <option value="ไทยพาณิชย์">- ไทยพาณิชย์</option>
		<option value="กรุงเทพ">- กรุงเทพ</option>
        <option value="กสิกรไทย">- กสิกรไทย</option>
        <option value="กรุงไทย">- กรุงไทย</option>
      </select> 
	<input type="text" name="location" placeholder="สาขา/รหัสตู้ ATM *" required> ธนาคาร - สาขา/รหัสตู้ ATM (ช่อง No/Location)<br>
	<input type="number" name="bath" placeholder="จำนวนเงิน (บาท) *" required>
    <input type="number" name="satang" placeholder="สตางค์"> บาท - สตางค์<br>
    <input type="text" name="date" placeholder="วันเดือนปี *" required readonly>
    <input type="number" name="hour" placeholder="ชั่วโมง *" min="0" max="23" required>
    <input type="number" name="min" placeholder="นาที *"  min="0" max="59" required>วันเดือนปี - เวลา (ชั่วโมง นาที)
    <button type="submit" style="display:none;"></button>
</form>
<?php
$show_submit = true;
}
?>
</div>
<div id="bottom">
<button id="index">&laquo; หน้าแรก</button>
<?php
if($show_submit) {
	echo '<button id="submit">ส่งข้อมูล &raquo;</button>';
}
?>
</div>
</div>
</body>
</html>
