<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 7-2</title>
<style>
	* {
		font: 16px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
	}
	b {
		font-weight: bold;
	}
</style>
</head>

<body>
<?php
include "user-info.php";
$ip = user_ip();
$browser = user_browser();
$os = user_os();

echo "ท่านใช้เบราเซอร์ $browser <br>บนระบบปฎิบัติการ $os";
echo "<hr>";
echo "<b>User Agent:</b><br>" . user_agent();
?>
</body>
</html>