<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
	$league = $_POST['league'];
	$club_id = $_POST['club_id'];
	
	$sql = "SELECT logo FROM clubs WHERE club_id = $club_id";
	$r = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($r);
	$logo = $data['logo'];
	unlink("images/logo-club/$logo");
	
	$sql = "DELETE FROM clubs WHERE club_id = $club_id";
	$r = mysqli_query($link, $sql);
	//ลบข้อมูลการแข่งขันของทีมนั้นออกไปด้วยทั้งกรณีเป็นเจ้าบ้านและทีมเยือน
	$sql = "DELETE FROM matches WHERE (league = '$league') AND (home_id = $club_id OR away_id = $club_id)";
	mysqli_query($link, $sql);

	mysqli_close($link);
}
?>