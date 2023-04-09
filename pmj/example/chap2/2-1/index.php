<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
</style>
</head>

<body>
 	<h3>
 	<?php
 		echo "PHP/MySQL/jQuery";
 	?>
 	</h3>

 	<div style="font-size:larger; color:blue;">
 	<?php
 		echo "<b>สิ่งที่ต้องติดตั้ง:</b>";
 	?>
 	</div>
    
 	<ul>
 	<?php
 		echo "<li>Apache</li>";
 		echo "<li>PHP</li>";
 		echo "<li>MySQL</li>";
 	?>
 	</ul>
</body>
</html>