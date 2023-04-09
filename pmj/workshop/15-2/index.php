<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 15-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin: 0px;
	}
	h1 {
		color: steelblue;
		font-size: 20px !important;
		margin: 10px;
	}
	aside {
		position: fixed;
		top: 0px;
		left: 0px;
		width: 200px;
		height: 100%;
		background: steelblue;
	}
	article {
		position: absolute;
		left: 200px;
		top: 0px;
		min-width: 250px;
	}	
	section#top {
		margin-top: 20px;
	}
	section#bottom {
		text-align: center;
		position: fixed;
		bottom: 25px;
		left: 5px;
		color:lightgray;
		font-size: 12px !important;
	}
	aside > h1 {
		color: yellow !important;
	}
	a {
		color: aqua;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
</style>
</head>

<body>
<aside>
	<h1>DeveloperThai.com</h1>
	<section id="top">
	</section>
    
    <section id="bottom">
    จำนวนผู้ที่กำลังออนไลน์: 
    <?php include_once "user-online.php"; ?>
    </section>
</aside>
<article>
	<h1>ตรวจสอบจำนวนผู้ใช้<br>ที่กำลังออนไลน์ในขณะนี้</h1>
</article>
</body>
</html>