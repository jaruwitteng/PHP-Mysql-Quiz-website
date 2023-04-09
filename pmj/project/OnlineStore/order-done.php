<?php
session_start();
if(!$_POST) {
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
<style>
	@import "global-order.css";
	div#panel {
		font-size: 16px;
		margin: 30px auto 30px 100px;
		color: navy;
		text-align: left;
	}
	div#panel > img {
		width: 64px;
		margin-right: 20px;
		float: left;
		vertical-align: top;
	}
	div#panel > div#text-done {
		float: left;
		width: 550px;
	}
	div#panel > div#text-done > span {
		font-size: 18px;
		color: green;
	}
	div#panel > div#text-done > div#order-detail {
		font-size: 14px !important;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('button#index').click(function() {
		location.href = "index.php";
	});
});
</script>
</head>
<body>
<div id="container">
<h5><img src="images/logo2.gif" class="logo2"></h5>
<div id="head"> <?php include "order-head.php"; ?> </div>
<div id="content">
<?php
include "dblink.php";
$cust_id = $_POST['cust_id'];
$email = $_POST['email'];
$pswd = $_POST['pswd'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$phone = $_POST['phone'];	

$sql = "REPLACE INTO customers VALUES(
			'$cust_id', '$email', '$pswd', '$firstname', '$lastname', '$address', '$phone')";
mysqli_query($link, $sql);
//ถ้าเป็นลูกค้าใหม่ให้อ่านค่า id ของข้อมูลที่พึ่งเพิ่มลงในตาราง customers
//ทั้งนี้หากเป็นลูกค้าเก่า จะมีค่า id เดิมโพสต์มากับฟอร์มแล้ว
if(empty($cust_id)) {
	$cust_id = mysqli_insert_id($link);
}
//สร้างรายการสั่งซื้อของลูกค้าคนนี้
$sql = "INSERT INTO orders VALUES('', '$cust_id', NOW(), 'no', 'no')";
$r = mysqli_query($link, $sql);
$order_id = mysqli_insert_id($link);

$sid = session_id();
$sql = "SELECT * FROM cart WHERE session_id = '$sid'";
$r = mysqli_query($link, $sql);

//นำข้อมูลจากตาราง cart มาเพิ่มลงในตาราง  order_details ทีละแถวจนครบ
while($cart = mysqli_fetch_array($r)) {
	$pro_id = $cart['pro_id'];
	$quan = $cart['quantity'];
	$attr = $cart['attribute'];
	$sql = "INSERT INTO order_details VALUES(
	 			'', '$order_id', '$pro_id', '$attr', '$quan')";
	mysqli_query($link, $sql);
}
//หลังจากคัดลอกข้อมูลของลูกค้ารายนั้นจากตาราง cart ไปจัดเก็บแล้ว ก็ลบข้อมูลในตาราง cart ทิ้ง
$sql = "DELETE FROM cart WHERE session_id = '$sid'";
mysqli_query($link, $sql);
 
mysqli_close($link);
$amount = $_SESSION['amount'];
?>
	<div id="panel">
		<img src="images/check.png">
    	<div id="text-done">
    		<span>การสั่งซื้อเสร็จเรียบร้อย</span><br><br>
            <div id="order-detail">
 				รายละเอียดการชำระค่าสินค้า มีดังนี้<br><br>
				<b>รหัสการสั่งซื้อ:</b> <?php echo $order_id; ?> <br>
				<b>รวมเป็นเงินทั้งสิ้น:</b> <?php echo $amount; ?>  บาท <br>
				<b>การโอนเงิน:</b><br>
					- ธนาคาร ไทยพาณิชย์ สาขา... ชื่อบัญชี... หมายเลข.... <br>
					- ธนาคาร กสิกรไทย สาขา... ชื่อบัญชี... หมายเลข.... <br>
					- ธนาคาร กรุงเทพ สาขา... ชื่อบัญชี... หมายเลข.... <br>
					- ธนาคาร กรุงไทย สาขา... ชื่อบัญชี... หมายเลข.... <br><br>
                    
 				หลังการโอนเงิน ให้เข้ามาที่หน้าแรกของเว็บไซต์แล้วคลิกที่ปุ่ม "แจ้งการโอนเงิน"<br>
 				กรุณาชำระเงินภายใน 7 วัน มิฉะนั้นข้อมูลการสั่งซื้อของท่านอาจจะถูกยกเลิก<br><br>

				ท่านสามารถตรวจสอบข้อมูลต่างๆเกี่ยวกับการสั่งซื้อสินค้าของท่าน เช่น
				รหัสการสั่งซื้อ, สถานะการโอนเงิน, การจัดส่ง โดยเข้ามาที่หน้าแรกของเว็บไซต์แล้วคลิกที่ปุ่ม "ประวัติการสั่งซื้อ"<br><br>

				ขอขอบพระคุณที่สั่งซื้อสินค้าจากเรา
    		</div>
    </div>
    <br class="clear">
</div>
</div>
<div id="bottom">
<button id="index">&laquo; หน้าแรก</button>
</div>
</div>
</body>
</html>