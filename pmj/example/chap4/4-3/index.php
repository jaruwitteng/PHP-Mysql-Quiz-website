<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 4-3</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	header {
		font-size: 24px;
		font-weight: bold;
		color: green;
		margin: 10px 0px 20px;
	}
	div.error {
		width: 200px; 
		margin: auto;
		border:solid 1px red; 
 		background-color:#ffc; 
		padding:3px;
	}
	footer {
		margin: 30px 0px 5px;
		color: gray;
	}
</style>
</head>

<body>
<?php
require "header.html";

$ip = $_SERVER['REMOTE_ADDR'];
if($ip == "127.0.0.1" || $ip == "::1") {  //ใน XAMPP จะอ่านค่า IP บน localhost ได้เป็น ::1
	include "error.php";
	show_error("IP [$ip] is banned!");
} 
else {
	echo "<p>Welcome to My Website</p>";
}
require "footer.php";
?> 
</body>
</html>