<?php
include "check-login.php";
include "dblink.php";
sleep(1);
$order_id = $_POST['order_id'];
$sql = "UPDATE orders SET delivery = 'yes' WHERE order_id = '$order_id'";
mysqli_query($link, $sql);

//ลบจำนวนคงเหลือของสินค้าแต่ละชนิดเท่ากับจำนวนที่ส่งออกไป
$sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
$r = mysqli_query($link, $sql);
while($item = mysqli_fetch_array($r)) {
	$pro_id = $item['pro_id'];
	$quan = $item['quantity'];
	$sql = "UPDATE products SET quantity = quantity - $quan WHERE pro_id = '$pro_id'";
	mysqli_query($link, $sql);
}

mysqli_close($link);
?>