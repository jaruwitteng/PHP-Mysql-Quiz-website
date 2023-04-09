<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
<style>
	@import "global-order.css";
</style>
</head>
<body>
<div id="container">
	<h5><img src="images/logo2.gif" class="logo2"></h5>
	<div id="head"> <?php include "order-head.php"; ?> </div>
	<div id="content">
		<br><br><br><br><br><br>
	</div>
	<div id="bottom">
		<button id="index">&laquo; ย้อนกลับ</button>
		<button id="next">ถัดไป &raquo;</button>
	</div>
</div>
</body>
</html>