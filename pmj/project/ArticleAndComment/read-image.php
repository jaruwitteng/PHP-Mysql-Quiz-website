<?php
include "dblink.php";
$id = $_GET['id'];
$sql = "SELECT image_content FROM image WHERE image_id = $id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_array($result);
header("Content-Type: image/jpeg");
echo $data['image_content'];
mysqli_close($link);
?>