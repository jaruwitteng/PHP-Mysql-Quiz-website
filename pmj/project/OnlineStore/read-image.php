<?php
include "dblink.php";
if(isset($_GET['pro_id'])) {
	$cond = "pro_id = " . $_GET['pro_id'];
}
else if(isset($_GET['img_id'])) {
	$cond = "img_id = " . $_GET['img_id'];
}
$sql = "SELECT img_content FROM images WHERE $cond ORDER BY img_id ASC LIMIT 1";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_array($result);
header("Content-Type: image/jpeg");
echo $data['img_content'];
mysqli_close($link);
?>