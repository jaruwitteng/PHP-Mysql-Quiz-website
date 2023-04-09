<?php
include("../../../lib/IMager/imager.php");

$img = image_load("elephant.jpg");
$img_mrg = image_load("php-logo.gif");

$img = image_merge($img, $img_mrg, CENTER_CENTER, 0,0,80);
image_echo($img);
image_destroy($img, $img_mrg);
?>