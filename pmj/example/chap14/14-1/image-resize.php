<?php
include("../../../lib/IMager/imager.php");

$img = image_load("elephant-php.gif");
$img = image_to_jpg($img);
$img_resize = image_resize_to_height($img, 150);
image_echo($img_resize);
image_destroy($img, $img_resize);
?>