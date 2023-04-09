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
	
	form {
		margin: 20px auto;
		width: 70%;
		border: solid 0px;
		font-size: 12px;
		color: green;
	}
	form  > * {
		font: 14px tahoma;
		padding: 3px;	
	}
	input {
		width: 200px;
		margin: 3px;
		background: #ffc;
		border: solid 1px gray;
	}
	h2.warning {
		text-align: left !important;
	}
	span#forget-pswd {
		width: 425px;
		display: block;
		text-align: right;
		margin: -5px 0px 10px 0px;
	}
	span#forget-pswd a {
		font-size: 12px;
	}
	#head {
		padding: 5px !important;
	}
	table {
		margin: 20px auto;
		border-collapse: collapse;
	}
	caption {
		text-align: left;
		padding-bottom: 3px !important;
	}
	td:nth-child(1) {
		width: 250px;
		text-align: left !important;
	}
	td:nth-child(2) {
		width: 200px;
		text-align: left !important;
	}
	td:nth-child(3), td:nth-child(4) {
		width: 80px;
	}
	td:nth-child(5), td[colspan]+td {
		width: 100px;
	}
	table th {
		background: green;
		color: yellow;
		padding: 5px;
		border-right: solid 1px white;
		font-size:12px;
	}
	tr:nth-of-type(odd) {
		background: lavender;
	}
	tr:nth-of-type(even) {
		background: whitesmoke;
	}
	td {
		text-align: center;
		vertical-align: top;
		padding: 3px 0px 3px 3px;
		border-right: solid 1px white;
	}
	tr:last-child td {
		border-top: solid 1px white;
		background: powderblue !important;
		padding: 5px;
		font-weight: bold;
		text-align: center !important;	
	}
	caption > div {
		float: right;
		color: navy;
	}
	caption img {
		height: 16px;
		float:none;
		vertical-align: bottom;
	}
	h3 {
		text-align: center;
		color: navy;
	}
	div#head > img {
		vertical-align: bottom;
		margin-right: 5px;
		height: 24px;
	}
	h5 {
		text-align: center;
		margin: 0px;
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
<div id="head"><img src="images/clock.png">ประวัติการสั่งซื้อ </div>
<div id="content">
<?php
include "dblink.php";
$err = "";
$name = "";
if($_POST['email']) {
	$email = $_POST['email'];
	$pswd = $_POST['pswd'];
	//ตรวจสอบว่าอีเมลและรหัวผ่านที่ใส่เข้ามาถูกต้องหรือไม่
	$sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$pswd'";
	$r = mysqli_query($link, $sql);
	if(mysqli_num_rows($r)==0) {
		$err = '<h2 class="warning">ท่านใส่อีเมลหรือรหัสผ่านไม่ถูกต้อง</h2>';
	}
	else {
		$data = mysqli_fetch_array($r);
		$name = $data['firstname'] . "   " . $data['lastname'];
		
		$cust_id = $data['cust_id'];
		$sql = "SELECT *, DATE_FORMAT(order_date, '%d-%m-%Y') AS order_date
					FROM orders WHERE cust_id = '$cust_id' ORDER BY order_id DESC LIMIT 50"; 
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) == 0) {
			echo "<h3>ไม่พบ</h3>";
		}
		echo "<h3>ประวัติการสั่งซื้อของคุณ: $name</h3>";
		while($data = mysqli_fetch_array($r)) {
			$order_id = $data['order_id'];
			$date =  $data['order_date'];
			//กำหนดภาพให้สอดคล้องกับสถานะการโอนเงินและจัดส่ง
			$img_pay = "images/no.png";
			$img_delivery = "images/no.png";
			if($data['paid'] == "yes") {
				$img_pay = "images/yes.png";
			}
			if($data['delivery'] == "yes") {
				$img_delivery = "images/yes.png";
			}
			$sql = "SELECT order_details.*, products.pro_id, products.pro_name, products.price  
			 			FROM order_details LEFT JOIN products 
						ON order_details.pro_id = products.pro_id
						WHERE order_details.order_id = '$order_id'";
			$result = mysqli_query($link, $sql);	
?>
  				<table border="0">
  					<caption>
   	 					วันที่: <?php echo $date; ?> &nbsp;&nbsp;
                        รหัสการสั่งซื้อ: <?php echo $order_id; ?>
  						<div><img src="<?php echo $img_pay; ?>"> การชำระเงิน  - 
                         		<img src="<?php echo $img_delivery; ?>"> การจัดส่งสินค้า</div>
  					</caption>
				<tr><th>ชื่อสินค้า</th><th>คุณลักษณะ</th><th>จำนวน</th><th>ราคา</th><th>รวม</th></tr>
				<?php
					$grand_total = 0;
					while($order = mysqli_fetch_array($result)) {
						$sub_total = $order['quantity'] * $order['price'];
				?>
				<tr>
    				<td><?php echo $order['pro_name']; ?></td>
    				<td><?php echo $order['attribute']; ?></td>
    				<td><?php echo $order['quantity']; ?></td>
    				<td><?php echo $order['price']; ?></td>
   					<td><?php echo number_format($sub_total); ?></td>
				</tr>
				<?php
					$grand_total += $sub_total;
				}
				?>
				<tr><td colspan="4">รวมทั้งหมด</td><td><?php echo number_format($grand_total); ?></td></tr>
			</table>
<?php
		}  //end while
	}		//end else
}

//ถ้าไม่มีข้อมูลโพสเข้ามา หรือเกิดข้อผิดพลาด ให้แสดงฟอร์มสำหรับใส่อีเมลและรหัสผ่าน
if(!$_POST || $err != "") {   
?>
<form method="post"><?php echo $err; ?>
	<span>กรุณาใส่อีเมลและรหัสผ่านที่ท่านใช้ในการสั่งซื้อสินค้า</span><br>
	<input type="email" name="email" placeholder="อีเมล *" required>
    <input type="password" name="pswd" placeholder="รหัสผ่าน *" maxlength="20" required>
    <button type="submit">ตกลง</button>
    <span id="forget-pswd"><a href="#">ลืมรหัสผ่าน</a></span>
</form>
<?php
}
?>
</div>
<div id="bottom"><button id="index">&laquo; หน้าแรก</button></div>
</div>
</body>
</html>
<?php  mysqli_close($link); ?>