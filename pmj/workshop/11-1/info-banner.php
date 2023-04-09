<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 11-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 650px;
	}
	table {
		border-collapse: collapse;
		margin: auto;
	}
	td {
		text-align: center;
	}
	td:nth-of-type(1), td:nth-of-type(2) {
		text-align: left !important;
	}
	td, th {
		padding: 5px;
		border-right: solid 1px white;
		font: 14px tahoma;
		word-wrap:break-word;
		vertical-align: top;
		max-width: 250px;
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
	a {
		text-decoration: none;
		color: blue;
	}
	a:hover {
		color:red;
	}
	caption {
		padding: 2px;
		font-size: 16px;
	}
	td > img {
		max-width: 200px;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

//อ่านข้อมูล banner ซึ่งตรงภาพ icon หากยังไม่สิ้นสุดกำหนดโฆษณาให้แสดงภาพ yes.png
//หากสิ้นสุดแล้ว ให้แสดงภาพ no.png
$sql = "SELECT *, DATE_FORMAT( date_end, '%d-%m-%Y') AS date_n, 
 			IF(date_end > NOW(), 'yes.png', 'no.png') AS icon 
			FROM banner ORDER BY date_end DESC LIMIT 30";
			
$rs = mysqli_query($link, $sql);

echo "<table><caption>ข้อมูลเกี่ยวกับป้ายโฆษณา</caption>";
echo "<tr><th>ภาพ</th><th>URL</th><th>แสดง</th><th>คลิก</th><th>สิ้นสุด</th><th>Active</th></tr>";
while($data = mysqli_fetch_array($rs)) {
	echo "<tr>";
	echo "<td><img src=\"banner/{$data['filename']}\"></td>";
	echo "<td>{$data['url']}</td>";
	echo "<td>{$data['views']}</td>";
	echo "<td>{$data['impressions']}</td>";
	echo "<td>{$data['date_n']}</td>";
	echo "<td><img src=\"icon/{$data['icon']}\"></td>";
	echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>
</body>
</html>