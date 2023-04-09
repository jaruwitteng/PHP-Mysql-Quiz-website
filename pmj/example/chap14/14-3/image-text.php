<?php
include("../../../lib/IMager/imager.php");

$img = image_load("jellyfish.jpg");
$img = image_text($img, "แมงกะพรุน", TOP_CENTER, 0, 0,20, "aqua");
$img = image_text($img, "www.developerthai.com", BOTTOM_RIGHT, 5, 10,20, "white", "Purisa.ttf");
image_echo($img);
image_destroy($img);
?>