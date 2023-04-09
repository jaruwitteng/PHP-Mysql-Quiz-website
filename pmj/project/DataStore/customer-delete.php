<?php
include "check-login.php";
include "dblink.php";
sleep(1);
$cust_id = $_POST['cust_id'];
$sql = "DELETE FROM customers WHERE cust_id = '$cust_id'";
mysqli_query($link, $sql);
mysqli_close($link);
?>