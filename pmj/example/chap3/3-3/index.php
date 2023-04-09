<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-3</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	table {
		border-collapse: collapse;
	}
	td:nth-child(1) {
		background: lavender;
		min-width: 250px;
	}
	td:nth-child(2) {
		max-width: 400px;
		background: white;
	}
	td {
		padding: 2px;
		border: solid 1px gray;
		word-wrap: break-word;
		font: 14px tahoma;
	}
</style>
</head>

<body>
<table>
<?php
foreach($_SERVER as $k => $v) {
	echo "<tr>	<td>\$_SERVER['$k']</td><td>$v</td></tr>";
}
?>
</table>
</body>
</html>