<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 14-7</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	img {
		border-radius: 5px;
	}
	h3 { 
	 	margin-bottom: 0px; 
	}
	div {
		text-align:center;
	}
</style>
<?php include("../../../lib/IMSlider/imslider-jquery.php"); ?>
</head>

<body>
<div><h3>แสดงภาพแกลเลอรี่ด้วย IMSlider</h3>
<?php
	slider_width(600);
	slider_height(150);
	slider_bg_color("#abc");
	
	slider_echo_dir("pics");
	
	//หรือวิธีกำหนดทีละภาพแบบเซต 
	/*
	$set = slider_new_set();
	slider_add_set($set, "pics/Desert.jpg");
	slider_add_set($set, "pics/Penguins.jpg", "นกเพนกวิน");
	...
	slider_echo_set($set);
	*/
?>
</div>
</body>
</html>