<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
	$league = $_POST['league'];
	//ลบข้อมูลจากตาราง matches
	$sql = "DELETE FROM matches WHERE league = '$league'";
	mysqli_query($link, $sql);
	
	//รีเซตข้อมูลผลคะแนน
	$sql = "UPDATE clubs SET played = 0, won = 0, drawn = 0, lost = 0, points = 0, goals_for = 0, goals_against = 0, goals_diff = 0
				WHERE league = '$league'";
	mysqli_query($link, $sql);
	
	echo "alert('อัปเดตข้อมูลเรียบแล้ว')";
	
	mysqli_close($link);
}
?>