<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Manager</title>
<style>
	@import 'global.css';
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
</head>

<body>
<div id="container">
<header>
	<a href="logout.php">ออกจากระบบ</a>
	<div id="logo">PHP File Manager</div>
</header>
<nav>
	<img src="images/home.png" height="30"><span>หัวข้อเพจ</span>
    <a href="#">Button #3</a>
    <a href="#">Button #2</a>
    <a href="#">Button #1</a>
</nav>
<section id="breadcrumbs">
    htdocs &raquo; test &raquo; sample
</section>
<article>
    	<br><br><br><br><br>
</article>
</div>
<footer>
	&copy; <?php echo date('Y'); ?> - All Rights Reserved
</footer>
</body>
</html>