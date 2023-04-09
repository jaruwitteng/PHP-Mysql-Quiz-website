<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error() . "</body></html>");

$sql = "SELECT * FROM people";
$r = mysqli_query($link, $sql);
mysqli_fetch_array($r);

$num_fields =  mysqli_num_fields($r);
for($i = 0; $i < $num_fields; $i++) {
	$f = mysqli_fetch_field_direct($r, $i);
	echo "Field #$i <br>";
	echo " ---- name:" . $f->name;
	echo " ---- Length: " . $f->length;
	echo " ----- Type: " . $f->type;
	$q = mysqli_fetch_lengths($r);
	echo " ---- Size: " . $q[$i];
	echo "<hr>";
}
mysqli_close($link);
?>
</body>
</html>