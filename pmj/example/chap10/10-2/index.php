<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 10-2</title>
<style>
	body {
		font: 16px tahoma;
		text-align: center;
		background: url(bg.jpg);
		color: green;
		margin-top: 30px;
	}
</style>
</head>

<body>
<?php
function get_microtime() {
	$mt = explode(" ", microtime());
	return $mt[0] + $mt[1];
}

$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error() . "</body></html>");
			
$sql = "SELECT * FROM people";

$time_start = get_microtime();
$result = mysqli_query($link, $sql);
$time_end = get_microtime();

$difftime = $time_end - $time_start;
$time = round($difftime, 4);
echo $sql . "<br><br>";
echo "ใช้เวลาประมวลผล: $time วินาที";
?>
</body>
</html>