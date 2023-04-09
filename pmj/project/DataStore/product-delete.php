<?php
sleep(1);
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
$pro_id = $_POST['pro_id'];
$sql = "DELETE FROM products  WHERE pro_id = '$pro_id'";
mysqli_query($link, $sql);

mysqli_close($link);
?>