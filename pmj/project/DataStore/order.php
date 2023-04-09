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
	td:nth-child(6), tr:last-child td:last-child {
		width: 30px;
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
	a.delete, a.order-detail {
		font-size: 11px;
		border: solid 1px #999;
		display: inline-block;
		padding: 0px 2px;
		text-decoration: none;
		color:blue;
		border-radius: 3px;
	}
	a.delete:hover, a.order-detail:hover {
		color:red;
		background: #ffc;
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
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
	h4 {
		margin: 5px 0px 20px;
		text-align: center;
		color: navy;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('.order-detail').click(function() {
		var orderID = $(this).attr('data-id');
		var custID = $(this).attr('data-cust');
		var url = "order-detail.php?order_id=" + orderID + "&cust_id=" + custID;
		location.href = url;
	});

	$('.delete').click(function() {
		if(!confirm('ยืนยันการลบ')) {
			return;
		}
		var itemID = $(this).attr('data-id');
		var d = {'item_id': itemID};
		$.ajax({
			url: 'order-delete.php',
			data: d,
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
include "lib/pagination.php";

$sql = "SELECT *, DATE_FORMAT(orders.order_date, '%d-%m-%Y') AS order_date
 			FROM orders ORDER BY order_id DESC";
$r = page_query($link, $sql, 20);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}

echo "<h4>รายการสั่งซื้อลำดับที่  $first - $last จาก $total</h4>";

while($data = mysqli_fetch_array($r)) {
	$order_id = $data['order_id'];
	$date =  $data['order_date'];
	$cust_id = $data['cust_id'];
	$img_pay = "images/no.png";
	$img_delivery = "images/no.png";
	if($data['paid'] == "yes") {
		$img_pay = "images/yes.png";
	}
	if($data['delivery'] == "yes") {
		$img_delivery = "images/yes.png";
	}
?>
<table>
<caption>
   	 วันที่: <?php echo $date; ?> &nbsp;รหัสการสั่งซื้อ: <?php echo $order_id; ?>
  	<div>
 		<a href="#" class="order-detail" data-id="<?php echo $data['order_id']; ?>" data-cust="<?php echo $data['cust_id']; ?>">รายละเอียด</a> - 
 		<img src="<?php echo $img_pay; ?>"> การชำระเงิน  - 
        <img src="<?php echo $img_delivery; ?>"> การจัดส่งสินค้า
 	</div>
</caption>
<tr><th>ชื่อสินค้า</th><th>คุณลักษณะ</th><th>จำนวน</th><th>ราคา</th><th>รวม</th><th>ลบ</th></tr>
<?php	
	$sql = "SELECT order_details.*, products.pro_id, products.pro_name, products.price  
		 		FROM order_details
 				LEFT JOIN products
				ON order_details.pro_id = products.pro_id
				WHERE order_details.order_id = '$order_id'";
				
 	$result = mysqli_query($link, $sql);	
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
 	<td><a href="#" class="delete" data-id="<?php echo $order['item_id']; ?>">ลบ</a></td>
</tr>
<?php
		$grand_total += $order['quantity'] * $order['price'];
	}
?>
<tr><td colspan="4">รวมทั้งหมด</td><td><?php echo number_format($grand_total); ?></td><td>&nbsp;</td></tr>
</table>
<br>
<?php
}
if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
	echo '<p id="pagenum">';
	page_echo_pagenums();
	echo '</p>';
}
mysqli_close($link);
?>
</article>
</body>
</html>