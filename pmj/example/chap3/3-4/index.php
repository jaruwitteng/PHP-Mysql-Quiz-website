<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
</style>
</head>

<body>
<?php
$thai_text_num = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
$num = "0814563972";
$len = strlen($num);
$text = "";
for($i = 0; $i < $len; $i++) {
	$n = $num[$i];
	$text .= $thai_text_num[$n];
}
echo "$num => $text";
?>
</body>
</html>