<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 11-2</title>
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
		margin: 10px
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
	section {
		text-align: center;
		position: fixed;
		bottom: 10px;
		left: 5px;
		color:lightgray;
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
	<section>
     	<!-- จะนับสถิติที่เพจนี้ จึงแทรกไฟล์ stat.php เข้ามา -->
		<?php include "stat.php"; ?>
        
        <!-- อ่านจำนวนรวมทั้งหมดของผู้มาเยือนมาแสดง โดยถ้าต่ำกว่า 7 หลัก ให้เติม 0 ข้างหน้าจนครบ 7
        		ฟังก์ชั่น count_visitor() อยู่ในไฟล์ stat.php ซึ่งเรา include เข้ามาแล้ว --> 
		ผู้มาเยือนลำดับที่: <?php echo str_pad(count_visitor(), 7, "0", STR_PAD_LEFT); ?><br>
        
		<a href="show-stat.php" target="_blank">ดูสถิติของผู้มาเยือน</a> 
	</section>
</aside>
<article>
	<h1>ทดสอบการบันทึกสถิติ<br>ของผู้เยี่ยมชมเว็บไซต์</h1>
</article>
</body>
</html>