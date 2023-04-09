<?php
sleep(1);
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";

$name = $_POST['pro_name'];
$detail = $_POST['detail'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$cat = $_POST['category'];
$sup = $_POST['supplier'];
$sql = "REPLACE INTO products VALUES(
 			'', '$cat', '$sup', '$name', '$detail', '$price', '$quantity')";
mysqli_query($link, $sql);
	
$pro_id = mysqli_insert_id($link);

//อ่านข้อมูลคุณลักษณะแบบอาร์เรย์ทีละคู่ แล้วเพิ่มลงในตาราง attributes
$c = count($_POST['attr_name']);
for($i = 0; $i < $c; $i++) {		
	if(!empty($_POST['attr_name'][$i]) && !empty($_POST['attr_value'][$i])) {
		$attr_name =  $_POST['attr_name'][$i];
		$attr_value = $_POST['attr_value'][$i];
		//ลบช่องว่างก่อนและหลังเครื่องหมาย "," ออก
		$attr_value = preg_replace("/[ ]*,[ ]*/i", ",", $attr_value);  
		$sql = "REPLACE INTO attributes VALUES(
		 			'', '$pro_id', '$attr_name', '$attr_value')";
		mysqli_query($link, $sql);
	}
}

$_SESSION['pro_id'] = $pro_id;
	
mysqli_close($link);
?>