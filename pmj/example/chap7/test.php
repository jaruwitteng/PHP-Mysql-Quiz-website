<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example Test</title>
</head>

<body>
<?php
$pattern = "/.*x$/";
$str = "banana";
echo (2==true); //preg_match($pattern, $str);


/*
$pattern = "/-|\//";  //ใช้ - หรือ / ในการคัดแยก
$date = "2014/06/07"; //หรืออาจเป็น  2014-06-07
$dt = preg_split($pattern, $date);
//$dt = array("2014","06", "07");
var_dump($dt);
*/
?>
</body>
</html>