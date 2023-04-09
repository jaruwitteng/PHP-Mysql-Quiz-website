<?php
session_start();

if($_POST) {
	$login = $_POST['login'];
	$password = $_POST['pswd'];
	
	if($login === "admin" && $password === "abc456") {
		$_SESSION['admin'] = 1;
	}
	else { 
		//ตรวจสอบว่าตรงกับ Login/Password ของสมาชิกหรือไม่
		//.......................
	}
	
	header("Location: index.php");
	exit;
}
?>