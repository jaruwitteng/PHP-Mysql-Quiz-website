<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 12-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
	}
	table {
		border-collapse: collapse;
		margin: auto;
		min-width: 300px;
	}
	td {
		text-align: left;
		vertical-align: top;
		max-width: 200px;
		word-wrap:break-word;
	}
	td, th {
		padding: 5px;
		border-right: solid 1px white;
		font: 14px tahoma;
	}
	td:last-child, th:last-child {
		border-right: solid 0px !important;
	}
	tr:nth-of-type(odd) {
		background: #dfd;
	}
	tr:nth-of-type(even) {
		background: #ddf;
	}
	th {
		background: green !important;
		color: yellow;
	}
	caption {
		text-align: left;
		margin-bottom: 5px;
	}
</style>
</head>

<body>
<?php
include("../pagination.php");

$link = mysqli_connect("localhost", "root", "abc456", "pmj");
$sql = "SELECT * FROM pagination";
$result = page_query($link, $sql, 10);

echo "<table><caption>";
echo "ข้อมูลลำดับที่: " . page_start_row() . " - " . page_stop_row() . 
 		" จากทั้งหมด: " . page_total_rows() . "</caption>";
		
echo "<tr><th>ID</th><th>Item</th></tr>";
		
while($data = mysqli_fetch_array($result)) {
	echo "<tr><td>{$data['id']}</td><td>{$data['item']}</td></tr>";
}
echo "</table><br>";
page_echo_pagenums(6, true);

mysqli_close($link);
?>
</body>
</html>