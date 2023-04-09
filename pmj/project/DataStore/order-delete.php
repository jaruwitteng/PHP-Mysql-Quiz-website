<?php
include "check-login.php";
include "dblink.php";
sleep(1);
$item_id = $_POST['item_id'];
$sql = "DELETE FROM order_details WHERE item_id = '$item_id'";
mysqli_query($link, $sql);
mysqli_close($link);
?>