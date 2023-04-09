<?php
include "dblink.php";
include "IMGallery/imgallery-no-jquery.php";

$id = $_GET['id'];
$sql = "SELECT * FROM shopping_cart WHERE item_id = '$id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);

echo "<table class=\"tb-detail\">";
echo "<tr><td>ชื่อสินค้า</td><td>{$data['name']}</td></tr>";
echo "<tr><td>รายละเอียด</td><td>{$data['detail']}</td></tr>";
echo "<tr><td>สีที่มีให้เลือก</td><td>{$data['color']}</td></tr>";
echo "<tr><td>ราคา</td><td>{$data['price']}</td></tr>";
echo "<tr><td>แกลเลอรี่</td>";
echo "<td>";

$img = preg_split("/[ ]*,[ ]*/", $data['image']);
gallery_thumb_height(60);

for($i = 0; $i < count($img); $i++) {
	gallery_echo_img("pics/".$img[$i]);
}

echo "</td></tr>";
echo "</table>";
mysqli_close($link);
sleep(1);
?>