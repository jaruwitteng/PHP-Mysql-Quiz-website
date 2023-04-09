<?php
sleep(1);
include "check-login.php";
if(!$_POST) {
	exit;
}
include "dblink.php";
$img_id = $_POST['img_id'];
$sql = "DELETE FROM images WHERE img_id = '$img_id'";
mysqli_query($link, $sql);
	
mysqli_close($link);
?>