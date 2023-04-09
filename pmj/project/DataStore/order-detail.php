<?php 
include "check-login.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Store</title>
<style>
	@import "global.css";
	caption {
		text-align: left;
		padding-bottom: 3px !important;
	}
	td:nth-child(1) {
		width: 50px;
	}
	td:nth-child(2) {
		width: 250px;
		text-align: left !important;
	}
	td:nth-child(3) {
		width: 200px;
		text-align: left !important;
	}
	td:nth-child(4) {
		width: 80px;
	}
	td:nth-child(5) {
		width: 80px;
	}
	td:nth-child(6), td[colspan]+td{
		width: 80px;
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
	td a:hover {
		color: red;
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
		color: purple;
	}
	caption > div > button {
		float: none !important;
	}
	caption > div > img {
		height: 16px;
		float:none;
		vertical-align: bottom;
	}
	section#customer {
		margin: 20px 0px 20px 60px;
		font-size: 14px;
	}
	section#customer > span {
		display: inline-table;
		width: 80px;
		font-weight: bold;
		margin: 2px;
	}
	hr {
		width: 85%;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('button#delivery').click(function() {
		if(!confirm('ยืนยันการจัดส่งสินค้าแล้ว')) {
			return;
		}
		var orderID = $(this).attr('data-id');
		$.ajax({
			url: 'order-delivery.php',
			data: {'order_id': orderID},
			dataType: 'html',
			type: 'post',
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				location.reload();
			},
			complete: function() {
				$.unblockUI();
			}
		})	;
	});
});
</script>
</head>

<body>
<?php include "top.php"; ?>
<article>
<?php
include "dblink.php";

$cust_id = $_GET['cust_id'];
$sql = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
$r = mysqli_query($link, $sql);
$cust = mysqli_fetch_array($r);
?>
<section id="customer">
	<span>ชื่อลูกค้า:</span><?php echo $cust['firstname'] . "  " . $cust['lastname'];?><br>
	<span>ที่อยู่:</span><?php echo $cust['address'];?><br>
	<span>โทร:</span><?php echo $cust['phone'];?><br>
	<span>อีเมล:</span><a href="mailto:<?php echo $cust['email'];?>"><?php echo $cust['email'];?></a><br>
</section>
<hr>
<?
$order_id = $_GET['order_id'];
$sql = "SELECT *, DATE_FORMAT(orders.order_date, '%d-%m-%Y') AS order_date
 			FROM orders WHERE order_id = '$order_id'";
$r = mysqli_query($link, $sql);
$data = mysqli_fetch_array($r);
?>
<table>
<caption>
	วันที่: <?php echo  $data['order_date']; ?> &nbsp;&nbsp;รหัสการสั่งซื้อ: <?php echo $data['order_id']; ?>
   <div>
   <?php
   		if($data['delivery'] == "no") {
			echo 'คลิกปุ่มนี้ถ้า <button type="button" id="delivery" data-id="' . $data['order_id'] . '">จัดส่งสินค้าแล้ว</button>';
		}	
		else if($data['delivery'] == "yes") {
			echo '<img src="images/yes.png"> จัดส่งสินค้าแล้ว';
		}
   ?>
    </div>
</caption>
<tr><th>ลำดับ</th><th>ชื่อสินค้า</th><th>คุณลักษณะ</th><th>ราคา</th><th>จำนวน</th><th>รวม</th></tr>
<?php
$sql = "SELECT order_details.*, products.pro_name, products.price 
 			FROM order_details
 			LEFT JOIN products
			ON order_details.pro_id = products.pro_id
			WHERE order_details.order_id = '$order_id'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_array($result);
$no = 1;
mysqli_data_seek($result, 0);
while($order = mysqli_fetch_array($result)) {
	$price = number_format($order['price']);
	$sub_total = $order['quantity'] * $order['price'];	
	
?>
<tr>
	<td><?php echo $no; ?></td>
    <td><?php echo $order['pro_name']; ?></td>
    <td><?php echo $order['attribute']; ?></td>
    <td><?php echo $price; ?></td>
    <td><?php echo $order['quantity']; ?></td>
    <td><?php echo number_format($sub_total); ?></td>
</tr>
<?php
	$grand_total += $sub_total;
	$no++;
}
?>
<tr><td colspan="5">รวมทั้งหมด</td><td><?php echo number_format($grand_total); ?></td></tr>
</table>
</article>
</body>
</html>