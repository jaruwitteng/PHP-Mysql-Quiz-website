<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 11-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 500px;
	}
	table {
		border-collapse: collapse;
		margin: auto;
	}
	td {
		text-align: left;
	}
	td:nth-of-type(1), td:nth-of-type(2) {
		text-align: center !important;
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
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

//แสดงข้อมูลย้อนหลังไปตามจำนวนวันที่กำหนด
$interval = 30;

//ขั้นแรกให้อ่านวันเดือนปีแบบไม่ซ้ำจากตาราง  โดยเรียงจากล่าสุดย้อนกลับไป
//เพื่อจะนำไปเปรียบเทียบว่า มีผู้มาเยือนในวันเดือนปีใดบ้าง
$sql = "SELECT DISTINCT(date_visited) FROM webstats 
 			ORDER BY date_visited DESC LIMIT $interval";
$result = mysqli_query($link, $sql);

//แสดงผลในแบบตาราง
echo "<table>";
echo "<caption>สถิติของผู้เข้าเยี่ยมชมในรอบ $interval วัน</caption>";
echo "<tr><th>วันเดือนปี</th><th>ผู้เยี่ยมชม</th><th>เบราเซอร์</th><th>ระบบปฏิบัติการ</th></tr>";

//ในแต่ละวันเดือนปีที่อ่านได้ จะใช้เป็นเงื่อนไขในการจัดกลุ่ม
while($dt = mysqli_fetch_array($result)) {
	$dv = $dt[0];		 //ข้อมูลที่ได้จะอยู่ในรูปแบบ ปี-เดือน-วัน	
	
	$ts = strtotime($dv);
	$date = date('d-m-Y', $ts);   //แปลงให้อยู่ในแบบ วัน-เดือน-ปี (ตรงนี้จะนำไปแสดงผล)
	
	//นับจำนวนผู้มาเยือนเฉพาะในวันนั้น
	$sql = "SELECT COUNT(*) FROM webstats WHERE date_visited = '$dv'";
	$rs = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($rs);
	$visitors = $data[0];
	
	//นับจำนวนแยกแต่ละเบราเซอร์ที่ผู้มาเยือนใช้ในวันนั้น
	$sql = "SELECT date_visited, browser, COUNT(*) AS num 
	 			FROM webstats GROUP BY date_visited, browser 
				HAVING date_visited = '$dv'
				ORDER BY num DESC";
	$rs = mysqli_query($link, $sql);
	
	//นำแต่ละค่าที่อ่านได้ไปรวมเป็นสตริงเดียวกัน
	$browser = "";
	while($data = mysqli_fetch_array($rs)) {
		$browser .= $data['browser'] . "&nbsp;";
		$browser .= "(".number_format($data['num']).")<br>";  //ไม่ใช้ฟังก์ชั่น FORMAT() ของ MySQL เพราะต้องใช้ในการเรียงลำดับ
	}
	
	//นับจำนวนแยกแต่ละระบบปฏิบัติการที่ผู้มาเยือนใช้ในวันนั้น
	$sql = "SELECT date_visited, os, COUNT(*) AS num 
	 			FROM webstats GROUP BY date_visited, os 
				HAVING date_visited = '$dv'
				ORDER BY num DESC";
	$rs = mysqli_query($link, $sql);
	
	//นำแต่ละค่าที่อ่านได้ไปรวมเป็นสตริงเดียวกัน
	$os = "";
	while($data = mysqli_fetch_array($rs)) {
		$os .= $data['os'] . "&nbsp;";
		$os .="(".number_format($data['num']).")<br>";   //ไม่ใช้ฟังก์ชั่น FORMAT() ของ MySQL เพราะต้องใช้ในการเรียงลำดับ
	}	
	
	//นำข้อมูลทั้งหมดของวันนั้น แสดงลงใน 1 แถวตาราง 
	echo "<tr>";
	echo "<td>$date</td><td>$visitors</td><td>$browser</td><td>$os</td>";
	echo "</tr>";
}

echo "</table>";
mysqli_close($link);
?>
</body>
</html>