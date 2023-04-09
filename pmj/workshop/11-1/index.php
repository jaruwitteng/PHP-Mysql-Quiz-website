<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 11-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 10px;
		min-width: 300px;
	}
	h1 {
		color: tomato;
		font-size: 40px !important;
		margin: 10px
	}
	footer {
		width: 100%;
		text-align: center;
		position: fixed;
		bottom: 5px;
	}
	a {
		color: blue;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
</style>
<body>
<header>
	<h1>DeveloperThai.com</h1>
</header>
<?php include "show-banner.php";  ?>
<br><br><br>
<footer>
	<a href="add-banner.php">เพิ่มป้ายโฆษณา</a> - 
    <a href="info-banner.php" target="_blank">ข้อมูลป้ายโฆษณา</a>
</footer>
</body>
</html>