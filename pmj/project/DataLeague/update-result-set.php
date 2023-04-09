<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if($_POST) {
	include "dblink.php";
	$match_id = $_POST['match_id'];
	$home_id = $_POST['home_id'];
	$away_id = $_POST['away_id'];
	$home_goals = $_POST['home_goals'];
	$away_goals = $_POST['away_goals'];

	$sql = "UPDATE matches SET home_goals = $home_goals, away_goals = $away_goals
				WHERE  match_id = $match_id";
	if(mysqli_query($link, $sql)) {
		update_table($home_id, $home_goals, $away_goals);		//เก็บข้อมูลของทีมเจ้าบ้าน
		update_table($away_id, $away_goals, $home_goals);		//เก็บข้อมูลของทีมเยือน
	}
 	mysqli_close($link);
}

function update_table($club_id, $goals_for, $goals_against) {
	global $link;
	//อ่านข้อมูลเดิมของทีมนั้น เพื่อมาแก้ไข
	$sql = "SELECT * FROM clubs WHERE club_id = $club_id";
	$result = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($result);
	
	$played = $data['played'] + 1;   //เพิ่มจำนวนที่ลงแข่งอีก 1
	$won = $data['won'];
	$drawn = $data['drawn'];
	$lost = $data['lost'];
	$points = $data['points'];
	$gf = $data['goals_for'] + $goals_for;   //เพิ่มจำนวนประตูที่ทำได้
	$ga = $data['goals_against'] +  $goals_against;   //เพิ่มจำนวนประตูที่เสีย
	$gd = $data['goals_diff'];
	
	if($goals_for >  $goals_against) {   //กรณีที่ชนะ (ประตูได้ > เสีย)
		$won += 1; 			//เพิ่มจำนวนครั้งที่ชนะ
		$points += 3;			//เพิ่มคะแนนไปอีก 3
		$gd += ($goals_for -  $goals_against);   //เพิ่มผลต่างประตู
	}
	else if($goals_for ==  $goals_against)  { //กรณีที่เสมอ (ประตูได้ = เสีย)
		$drawn += 1;		//เพิ่มจำนวนครั้งที่เสมอ
		$points += 1;			//เพิ่มคะแนนไปอีก 1
	}
	else if($goals_for <  $goals_against) {   //กรณีที่แพ้ (ประตูได้ < เสีย)
		$lost += 1;			//เพิ่มจำนวนครั้งที่แพ้
		$gd -= ( $goals_against - $goals_for);   //เพิ่มผลต่างประตู
	}
	
	$sql = "UPDATE clubs SET
				played = $played, won = $won, drawn = $drawn, lost = $lost, 
				points = $points, goals_for = $gf, goals_against = $ga, goals_diff = $gd
				WHERE club_id = $club_id";
	mysqli_query($link, $sql);
}
?>