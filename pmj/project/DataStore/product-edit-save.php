<?php
sleep(1);
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
$pro_id = $_POST['pro_id'];
$name = $_POST['pro_name'];
$detail = $_POST['detail'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$cat = $_POST['category'];
$sup = $_POST['supplier'];
$sql = "REPLACE INTO products VALUES($pro_id, '$cat', '$sup', '$name', '$detail', '$price', '$quantity')";
mysqli_query($link, $sql);
		
$c = count($_POST['attr_name']);
for($i = 0; $i < $c; $i++) {		
	$attr_id = $_POST['attr_id'][$i];
	if(!empty($_POST['attr_name'][$i]) && !empty($_POST['attr_value'][$i])) {
		$attr_name =  $_POST['attr_name'][$i];
		$attr_value = $_POST['attr_value'][$i];
		$attr_value = preg_replace("/[ ]*,[ ]*/i", ",", $attr_value);
		$sql = "REPLACE INTO attributes VALUES('$attr_id', '$pro_id', '$attr_name', '$attr_value')";
	}
	else {
		$sql = "DELETE FROM attributes WHERE attr_id = '$attr_id'";
	}
	mysqli_query($link, $sql);
}
	
mysqli_close($link);
?>