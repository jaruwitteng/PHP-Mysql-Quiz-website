<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 2-5</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	table {
		border-collapse: collapse;
		margin: auto;
	}
	td {
		padding: 3px 5px;
		border: solid 1px gray;
		text-align: center;
	}
	tr:nth-of-type(odd) {
		background: #cdf;
	}
	tr:nth-of-type(even) {
		background: #ddd;
	}
</style>
</head>

<body>
<table>
<caption>ตารางสูตรคูณ</caption>
<?php
 	//$i เป็นตัวนับในแนวบนลงล่าง
 	for($i = 1; $i <= 10; $i++) { 	
 	 	echo "<tr>";
	 	//$j ตัวนับในแนวซ้ายไปขวา
 	 	for($j = 1; $j <= 10; $j++) { 	
 		 	echo "<td>" . ($i * $j) . "</td>";
 	 	}
 	 	echo "</tr>";  
 	}
?>
</table>
</body>
</html>