<?php
session_start();
if(!isset($_SERVER['PHP_AUTH_USER'])){
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
 	exit("Please enter login and password");
}
else {
 	$user = $_SERVER['PHP_AUTH_USER'];
	$pw = $_SERVER['PHP_AUTH_PW'];

	if(($user != "admin") && ($pw != "abc456")) {
		exit("Login:admin<br>Password:abc456"); 
	}
	else {
		$_SESSION['user'] = "Administrator";
		header("location: index.php");
		exit;
	}
}
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 17-1</title>
</head>

<body>
</body>
</html>