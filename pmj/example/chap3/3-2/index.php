<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
</style>
</head>

<body>
<?php
$a = array("img1", "img10", "img11", "img1-1", "img1-2", "IMG123");
$b = $a;

echo "<b>ก่อนการเรียงลำดับ:</b><br>";
echo implode(", ", $a);

sort($a);
echo "<br><br><b>หลังใช้  sort(): </b><br>";
echo implode(", ", $a);

natcasesort($b);
echo "<br><br><b>หลังใช้  natcasesort(): </b><br>";
echo implode(", ", $b);
?>
</body>
</html>