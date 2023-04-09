<?php
session_start();
	
$a = array();
if(isset($_SESSION['cart'])){
	$a = $_SESSION['cart'];
}
echo json_encode($a);
sleep(1);
?>