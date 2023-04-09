<?php
if(!$_GET['id']) {
	exit;
}

$bid = $_GET['id'];
$link= @mysqli_connect("localhost", "root", "abc456", "pmj");

//เพิ่มจำนวนคลิกไปอีก 1
$sql = "UPDATE banner SET impressions = impressions + 1 WHERE bid = $bid";
@mysqli_query($link, $sql);

//อ่าน url ของ banner นั้นเพื่อเปิดไปยังเพจเจ้าของ banner
$sql = "SELECT url FROM banner WHERE bid = $bid";
$rs = @mysqli_query($link, $sql);
$bn = @mysqli_fetch_array($rs);
$url = $bn['url'];
@mysqli_close($link);

header("location: $url");    //เปิด(Rediredt)ไปยัง URL  ของ banner นั้น
exit;
?>