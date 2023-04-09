<?php
include($_SERVER['DOCUMENT_ROOT']."/pmj/lib/imagination/imagination.php");

$img = image_load("penguins.jpg");
//$img_mrg = image_load("php-logo.gif");

//$c = image_rgb(150, 0, 255);
//$img_new = image_crop($img, CENTER_LEFT, 100, 100, 0, 0); 
//image_merge($img, $img_mrg, BOTTOM_RIGHT, 5,5,70);
//$img_new = image_text($img, "ผมรักปุ้ย", 0, 0, 20, 'hotpink');
$img_new = image_text($img, "รูปภาพ", TOP_CENTER	, 0, -8, 30, 'red', "tahoma.ttf");
//$img = image_rotate($img_src, -90);

//$img_new = image_resize($img, 200, 150);

image_echo($img_new);

image_destroy($img_new);

image_destroy($img);


?>