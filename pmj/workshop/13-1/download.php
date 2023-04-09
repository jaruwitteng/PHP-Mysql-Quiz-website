<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");
			
$id = $_GET['id'];
$sql = "UPDATE fileshare SET file_download = file_download + 1 WHERE file_id = '$id'";
mysqli_query($link, $sql);

$sql = "SELECT * FROM fileshare WHERE file_id = '$id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);

$type = $data['file_type'];
$t = explode("/", $type);
$src = "{$t[0]}/{$data['file_name']}";

header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=$src");
header("Content-Transfer-Encoding:binary");

readfile("$src");	 

mysqli_close($link);
?>