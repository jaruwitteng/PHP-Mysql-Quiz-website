<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 13-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		margin: 0px;
		min-width: 600px;
		text-align: center;
	}
	header {
		width: 100%;
		position: fixed;
		top: 0px;
		left: 0px;
		background: #444;
		height: 60px;
		z-index: 10000;
	}
	div#top, div#content, div#menu {
		width: 600px;
		margin: auto;
	}
	nav {
		position: relative;
		display: inline-block;
		top: 60px;
		margin: auto;
		width: 100%;
		height: 30px;
		background: #069;
		text-align: left !important;
		padding: 5px 0px;
	}
	article {
		position: relative;
		top: 60px;
		margin: auto;
		width: 600px;
		text-align: left !important;
		padding-top: 20px;
	}
	form {
		float: right;
		text-align: right;
		padding-top: 1px;
	}
	header h3 {
		float: left;
		font: normal 32px tahoma;
		color: aqua;
		margin: 5px 0px;
	}
	header span {
		font: normal 24px tahoma;
		color: aqua;
	}
	[type=text]  {
		width: 150px;
		background: #ffc;
		border: solid 1px aqua;
		border-right: none !important; 
		border-radius: 4px 0px 0px 4px; 
		margin-right: -3px;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px aqua;
		border-left: none !important; 
		border-radius: 0px 4px 4px 0px; 
		font-weight: bold;
		margin-left: -3px; 
		height: 28px;
	}
	button:hover {
		color: aqua;
	}
	a:hover {
		color: red;
	}
	br.clear {
		clear: right;
	}
	p#pagenum {
		text-align: center;
		margin: 10px;
	}
	nav a {
		display: inline-block;
		border-right: solid 1px silver;
		padding: 5px 15px 5px 10px;
		color: white;
		text-decoration: none;
		font-size: 16px;
	}
	nav a:first-child {
		border-left: solid 1px silver;
		padding-left: 15px !important;
	}
	#iframe {
		display: none;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	tr {
		border-bottom: dotted 1px #333;
	}
	tr:nth-of-type(1) {
		border-top: dotted 1px gray;
	}
	td:nth-child(1),  td:nth-child(3) {
		width: 15%;
		text-align: center;
	}
	td:nth-child(2) {
		width: 70%;
	}
	td {
		vertical-align: top;
		padding: 5px 3px;
	}
	td:nth-child(1)  img {
		width: 72px;
		height: 72px;
	}
	td:nth-child(3)  img {
		width: 36px;
		height: 36px;
	}
	td > a {
		color: blue;
		margin: 3px 0px;
	}
	td > div {
		margin: 5px 0px;
	}
	td > span {
		display: inline-block;
		width: 200px;
		color: green;
	}
</style>
</head>

<body>
<header>
<div id="top">
	<h3>File Sharing <span>&</span> Download Manager</h3>
</div>
</header>
<nav>
<div id="menu">
<a href="?">All</a>
<a href="?type=image">Image</a>
<a href="?type=video">Video</a>
<a href="?type=audio">Audio</a>
<a href="upload.php">Upload</a>
    <form method="get">
		<input type="text" name="q" maxlength="30" value="<?php echo stripslashes($_GET['q']); ?>" required>
        <button>ค้นหา</button>
 	</form>
</div>
</nav>
<article>
<div id="content">
<?php
include "pagination.php";
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

$find = "ทั้งหมด";
$condition = 1;

//ถ้ามีพารามิเตอร์ type ส่งเข้าแสดงค้าหาตามชนิดของไฟล์
if($_GET['type']) {
	$type = $_GET['type'];
	$condition = "file_type LIKE '$type%'";
	$find = $type;
}
//ถ้ามีพารามิเตอร์ q ส่งเข้าแสดงค้าหาตามคีย์เวิร์ด
//ขั้นตอนการกำหนดเงื่อนไข ใช้หลักการเดียวกับ Workshop 12-1
else if($_GET['q']) {
	$q =  trim($_GET['q']);
	$find = $q;
	
	$pat = "/[ ]{1,}/";
	$w = preg_split($pat, $q);
	
	$file_name = array();
	foreach($w as $k) {
		$x = "(file_name LIKE '%$k%')";  
		array_push($file_name, $x);
	}
	$file_name = implode(" OR ", $file_name);
	
	$file_detail = array();
	foreach($w as $k) {
		$x = "(file_detail LIKE '%$k%')";  
		array_push($file_detail, $x);
	}
	$file_detail = implode(" OR ", $file_detail); 

	$condition = "$file_name OR $file_detail"; 
}
$sql = "SELECT * FROM fileshare WHERE $condition ORDER BY file_id DESC";
$rs = page_query($link, $sql, 5);

echo "ค้นหาไฟล์: " . stripslashes($find);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
echo "<span id=\"result\">ผลลัพธ์ที่: $first - $last จากทั้งหมด $total </span><br><br>"; 

echo "<table>";
while($data = mysqli_fetch_array($rs)) {
	$type = explode("/", $data['file_type']);
	
	$src = "icon/{$type[0]}.png";
	
	echo "<tr>";
	echo "<td><img src=\"$src\"></td>";
	echo "<td>";
	
	echo "<a href=\"view.php?id={$data['file_id']}\" target=\"_blank\">{$data['file_name']}</a>";
	echo "<div>{$data['file_detail']}</div>";
	echo "<span>ขนาด: " . convert_filesize($data['file_size']) . "</span>";
	echo "<span>ดาวน์โหลด: " . number_format($data['file_download']) . "</span>";
	echo "</td>";
	echo "<td>";
	echo "<a href=\"view.php?id={$data['file_id']}\" target=\"_blank\"><img src=\"icon/view.png\" title=\"เปิด\"></a><br>";
	echo "<a href=\"download.php?id={$data['file_id']}\" target=\"iframe\"><img src=\"icon/arw-down.png\" title=\"ดาวน์โหลด\"></a>";
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

//ต่อไปให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ 
if(page_total() > 1) { 	
	echo '<p id="pagenum">';
	page_echo_pagenums();
	echo '</p>&nbsp;';
}
mysqli_close($link);

function convert_filesize($size_in_bytes, $precision=2) {
	$units = array("GB"=>1073741824, "MB"=>1048576, "KB"=>1024);
	foreach($units as $u => $v) {
		if($size_in_bytes >= $v) {
			return  round(($size_in_bytes/$v), $precision) . " $u";
		}
	}
	return $bytes . " Bytes";   //กรณีที่ไม่สามารถเปลี่ยนเป็นหน่วยใดในอาร์เรย์ ให้ส่งกลับค่านี้
}
?>
</div>
</article>
<iframe id="iframe"></iframe>
</body>
</html>