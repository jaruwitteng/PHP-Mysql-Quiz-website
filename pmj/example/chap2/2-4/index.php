<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
</style>
</head>

<body>
<?php
 	$year = 2014;
 	if($year % 4 == 0) { 	//เงื่อนไขที่ 1 ต้องหารด้วย 4 ลงตัว แต่หารด้วย 100 ไม่ลงตัว
 		if($year % 100 != 0) {
 			echo $year . " is a leap year";
 		}
 		else {
 			echo $year . " is not a leap year";
 		}
 	}
 	else if($year % 400 == 0) {	//หรือเงื่อนไขที่ 2 ต้องหารด้วย 400 ลงตัว
 	 	echo $year . " is a  leap year";
 	}	
 	else { 					//กรณีอื่นๆ จะไม่เป็น leap year
 		echo $year . " is not a leap year";
 	}
?>
</body>
</html>