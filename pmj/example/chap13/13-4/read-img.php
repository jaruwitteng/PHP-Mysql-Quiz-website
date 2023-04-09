<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj");

$id = $_GET['id'];

$sql = "SELECT * FROM files WHERE file_id = $id";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);
$type = $data['file_type'];

header("Content-type: $type");  
echo $data['file_content'];

mysqli_close($link);
?>
