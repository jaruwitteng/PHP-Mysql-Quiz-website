<?php
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
if($_POST['action'] == "add") {
	$name = $_POST['sup_name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$contact = $_POST['contact_name'];
	$website = $_POST['website'];
	$sql = "REPLACE INTO suppliers 
	 		 	VALUES('', '$name', '$address', '$phone', '$contact', '$website')";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "edit") {
	$name = $_POST['sup_name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$contact = $_POST['contact_name'];
	$website = $_POST['website'];
	
	$id = $_POST['sup_id'];
	$sql = "UPDATE suppliers SET sup_name = '$name', address = '$address', phone = '$phone', contact_name = '$contact', website = '$website'
	 			WHERE sup_id = $id";
	mysqli_query($link, $sql);
}
if($_POST['action'] == "del") {
	$id = $_POST['sup_id'];
	$sql = "DELETE FROM suppliers WHERE sup_id = $id";
	mysqli_query($link, $sql);
}
mysqli_close($link);
?>