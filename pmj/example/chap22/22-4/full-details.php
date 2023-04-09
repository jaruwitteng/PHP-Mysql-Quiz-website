<?php
include "data.php";
include "../../../lib/IMGallery/imgallery-no-jquery.php";

$id = $_GET['id'];
echo "
<table class=\"tb-detail\">
<tr><td>ชื่อสินค้า</td><td>{$names[$id]}</td></tr>
<tr><td>รายละเอียด</td><td>{$details[$id]}</td></tr>
<tr><td>สีที่มีให้เลือก</td><td>{$colors[$id]}</td></tr>
<tr><td>ราคา</td><td>{$prices[$id]}</td></tr>
<tr>
<td>แกลเลอรี่</td>
<td>
";
gallery_thumb_height(60);
for($i=0; $i<count($images[$id]); $i++) {
	gallery_echo_img("pics/".$images[$id][$i]);
}

echo "
</td>
</tr>
</table>
";
sleep(1);
?>
