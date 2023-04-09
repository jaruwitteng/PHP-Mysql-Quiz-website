<?php
include("../../../lib/IMager/imager.php");

$img = image_load("elephant-php.gif");
$img = image_to_jpg($img);
$img_crop = image_crop($img, TOP_RIGHT, 100, 100, 0, 0);
image_echo($img_crop);
image_destroy($img, $img_crop);
?>