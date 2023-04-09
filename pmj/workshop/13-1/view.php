<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 13-1</title>
<style>
	body {
		text-align: center;
	}
	h3 {
		margin: 10px 0px;
		font: 14px tahoma;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");
			
$id = $_GET['id'];
$sql = "SELECT * FROM fileshare WHERE file_id = '$id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);

$type = $data['file_type'];
$t = explode("/", $type);
$src = "{$t[0]}/{$data['file_name']}";
echo "<h3>ไฟล์: {$data['file_name']}</h3>";

if($t[0]=="image") {
	echo "<img src=\"$src\">";
}
else if($t[0]=="video") {
	echo '<video src="'.$src.'" width="320" height="240" preload="auto" controls></video>';
}
else if($t[0]=="audio") {
	echo '<audio src="'.$src.'" preload="auto" controls></audio>';
}
else {
	echo "<h3>ไม่สามารถเปิดไฟล์นี้ได้ กรุณาดาวน์โหลดมาเปิดบนเครื่องของท่านเอง</h3>";
}

mysqli_close($link);
?>
</body>
</html>