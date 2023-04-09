<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 14-5</title>
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
</style>
<?php  include ("../../../lib/IMGallery/imgallery-jquery.php");  ?>
</head>

<body>
<?php	
	echo "<h3>Gallery แบบแยกแต่ละภาพ</h3>";
	gallery_echo_img("pics/Jellyfish.jpg");
	gallery_echo_img("pics/Koala.jpg");

	echo "<h3>Gallery แบบจัดกลุ่ม</h3>";
	$set = gallery_new_set();
	gallery_add_set($set, "pics/Penguins.jpg");
	gallery_add_set($set, "pics/Tulips.jpg");
	gallery_add_set($set, "pics/Desert.jpg");
	gallery_echo_set($set);

	echo "<h3>Gallery แบบแสดงทั้งไดเร็กทอรี</h3>";
	gallery_echo_dir("pics/");
?>
</body>
</html>