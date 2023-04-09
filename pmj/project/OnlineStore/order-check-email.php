<?php
sleep(1);
include "dblink.php";
if($_POST['email']) {
	$email = $_POST['email'];
	$cust_id = $_POST['cust_id'];
	
	$sql = "SELECT COUNT(*) FROM customers WHERE email = '$email'";
	
	//ถ้าเป็นลูกค้าเก่าจะมีค่า cust_id โพสต์เข้า ให้นำอีเมลไปตรวจสอบกับของคนอื่น
	//แต่ไม่ต้องตรวจสอบกับอีเมลของตนเอง
	if(!empty($cust_id)) {
		$sql .= " AND cust_id != '$cust_id'";	
	}
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	if($row[0] != 0) {
		echo "อีเมลที่ท่านระบุตรงกับของลูกค้าท่านอื่น กรุณาแก้ไข";
	}
}
mysqli_close($link);

/*
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	echo "ท่านใส่อีเมลไม่ตรงตามรูปแบบ";
}
*/
?>