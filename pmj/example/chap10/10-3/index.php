<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 10-3</title>
<style>
	body {
		background: url(bg.jpg);
	}
	table {
		border-collapse: collapse;
		min-width: 600px;
		margin: auto;
	}
	td {
		padding: 5px;
		border-right: solid 1px white;
		font: 14px tahoma;
		word-wrap:break-word;
	}
	td:last-child {
		border-right: solid 0px !important;
	}
	tr:nth-of-type(odd) {
		background: #dfd;
	}
	tr:nth-of-type(even) {
		background: #ddf;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error() . "</body></html>");
			
$sql = "SELECT * FROM people";
$result = mysqli_query($link, $sql);
if(!$result) {
	echo mysqli_error($link);
}
else if(mysqli_num_rows($result) == 0) {
	echo "ไม่มีข้อมูลในตาราง people";
}
else {
	echo "<table><caption>ข้อมูลจากตาราง people</caption>";
	
	//อ่านข้อมูลที่ละแถวจาก result set ในแบบอาร์เรย์
	while($data = mysqli_fetch_array($result)) {
		echo "<tr>"; 	//เริ่มแถวใหม่
		echo "<td>{$data['id']}</td>
		 		<td>{$data['name']}</td>
				<td>{$data['address']}</td>
				<td>{$data['email']}</td>
				<td>{$data['birthday']}</td>";
		echo "</tr>";	
	}
	echo "</table>";
}
mysqli_close($link);
?>
</body>
</html>