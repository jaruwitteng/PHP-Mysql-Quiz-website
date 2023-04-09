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
	#head {
		padding: 5px !important;
	}
	h3 {
		text-align: center;
		color: navy;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('button#index').click(function() {
		location.href = "index.php";
	});
});
</script>
</head>
<body>
<div id="container">
<h5><img src="images/logo2.gif" class="logo2"></h5>
<div id="head"><img src="images/phone.png">ติดต่อเรา</div>
<div id="content">
  <h3>???????????????</h3>
</div>
<div id="bottom"><button id="index">&laquo; หน้าแรก</button></div>
</div>
</body>
</html>
