<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
  	$datetime = $_POST['date'] . " " . $_POST['time'];
	$league = $_POST['league'];
	$home = $_POST['club_home'];
	$away = $_POST['club_away'];
	$remark = $_POST['watch'];

	$sql = "REPLACE INTO matches VALUES(
				'', '$datetime', '$league', '$home', '$away', '$watch',  NULL, NULL)";
	$result = mysqli_query($link, $sql);
	
 	mysqli_close($link);
}
?>