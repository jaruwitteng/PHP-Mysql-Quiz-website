<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
	$match_id = $_POST['match_id'];
	
	$sql = "DELETE FROM matches WHERE match_id = $match_id";
	@mysqli_query($link, $sql);
 	@mysqli_close($link);
}
?>