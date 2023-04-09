<?php
session_start();
if(!isset($_SESSION['name'])) {
	echo "enterName();";
	exit();
}

include "dblink.php";
$name = $_SESSION['name'];
$msg = $_POST['msg'];
$sql = "INSERT INTO chitchat VALUES(NOW(), '$name', '$msg')";
mysqli_query($link, $sql);
mysqli_close($link);
?>