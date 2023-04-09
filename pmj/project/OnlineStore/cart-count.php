<?php
session_start();
include "dblink.php";
$sid = session_id();
$sql = "SELECT SUM(quantity) FROM cart WHERE session_id = '$sid'";
$r = mysqli_query($link, $sql);
$row = mysqli_fetch_array($r);
echo empty($row[0])?0:$row[0];

mysqli_close($link);
?>