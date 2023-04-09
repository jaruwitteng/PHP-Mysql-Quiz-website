<?php
include "dblink.php";
$rid = $_GET['id'];
$sql = "SELECT img_content FROM image WHERE resume_id = $rid";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_array($result);
header("Content-Type: image/jpeg");
echo $data['img_content'];
mysqli_close($link);
?>