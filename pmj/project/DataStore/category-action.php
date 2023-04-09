<?php
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
if($_POST['action'] == "add") {
	$cat = $_POST['cat'];
	$sql = "REPLACE INTO categories VALUES('', '$cat')";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "edit") {
	$cat = $_POST['cat'];
	$cat_id = $_POST['cat_id'];
	$sql = "UPDATE categories SET cat_name = '$cat' WHERE cat_id = $cat_id";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "del") {
	$cat_id = $_POST['cat_id'];
	$sql = "DELETE FROM categories WHERE cat_id = $cat_id";
	mysqli_query($link, $sql);
}
mysqli_close($link);
?>