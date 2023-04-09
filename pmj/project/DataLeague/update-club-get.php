<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if(isset($_GET['league'])) {
	include "dblink.php";
	$lg =  $_GET['league'];
	$sql = "SELECT * FROM clubs WHERE league = '$lg' ORDER BY club_name";
	$result = mysqli_query($link, $sql);
	while($club = mysqli_fetch_array($result)) {
		$src = "images/football.png";
		if(!empty($club['logo'])) {
			$src = "images/logo-club/" . $club['logo'];
		}
		echo "
       <span class=\"club\">
        	<img src=\"$src\">{$club['club_name']}<br>
            <a href=\"#\" data-id=\"{$club['club_id']}\" data-club=\"{$club['club_name']}\">แก้ไข</a>
            <a href=\"#\" data-id=\"{$club['club_id']}\" data-club=\"{$club['club_name']}\">ลบ</a>
        </span>";		
	}
	
	@mysqli_close($link); 
}
?>
