<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="3">
<title>Example 4-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	img {
		border: solid 1px gray;
	}
</style>
</head>

<body>
<?php
	$banners = array(1=>"b1.jpg", "b2.jpg", "b3.jpg", "b4.jpg");
	$num_banners = count($banners);
	$n = rand(1, $num_banners);
	
	$img = $banners[$n];
?>
<h3>The PHP Company</h3>
<img src="<?php echo $img; ?>">
</body>
</html>