<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$path = "C:/xampp/htdocs/pmj/project/FileManager/images/file-types/txt-rtf.png";
echo dirname($path); exit;
$server =  $_SERVER['SERVER_NAME'];

$root = $_SERVER['DOCUMENT_ROOT'];

$src = str_ireplace($root, $server, $path);

echo $src;

$dirname = dirname($root);
$basename = basename($root);
$pos =  strpos($root, $basename);
$breadcrumb_str = substr($root, $pos);
//echo $breadcrumb_str;
exit;


$ex = array('html', 'htm', 'xml');
$t1 = array_fill_keys($ex, 'markup.png');

$ex = array('jpg', 'jpeg', 'gif', 'png', 'ico', 'bmp', 'tif', 'tiff');
$t2 = array_fill_keys($ex, 'image.png');

$t3 = array('php' =>'php.png');

$types = array_merge($t1, $t2, $t3);

$ext = "php";
if(array_key_exists($ext, $types)) {
	echo $types[$ext];
}
else {
	echo "no";
}
?>

</body>
</html>