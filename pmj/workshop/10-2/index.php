<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 10-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 700px;
	}
	table {
		border-collapse: collapse;
		min-width: 600px;
		margin: auto;
	}
	td {
		text-align: left;
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
		text-align: left;
		padding: 2px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 2px 10px;
	}
	img {
		height: 20px;
		vertical-align: text-top;
	}
</style>
</head>

<body>

<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

//กรณีเลือก checkbox แล้วโพสต์กลับขึ้นมา
if($_POST) {
	$id = implode(", ", $_POST['id']);
	$sql  = "DELETE FROM people WHERE id IN($id)";
	mysqli_query($link, $sql);
}

$sql = "SELECT * FROM people";
$result = mysqli_query($link, $sql);

//อ่านข้อมูลใน result set มาแสดงในแบบตาราง
echo '<form method="post">';
echo "<table>";
echo '<caption>
			<img src="arrow-down.gif">
 			<button>ลบแถวที่เลือก</button>
 			<a href="form.php?action=insert">เพิ่มข้อมูล</a></caption>';

//ส่วนหัวตาราง(ชื่อฟิลด์)
echo "<tr>"; 
$num_fields = mysqli_num_fields($result);
echo "<th>&nbsp;</th>";
echo "<th>action</th>";
for($i = 0; $i < $num_fields; $i++) {
	$f = mysqli_fetch_field_direct($result, $i);
	echo "<th>".$f->name."</th>";
}
echo "</tr>";

while($data = mysqli_fetch_array($result)) {
	echo  "<tr>";
	echo '<td><input type="checkbox" name="id[]" value="'.$data['id'].'"></td>';
	echo "<td>
				<a href=\"form.php?action=update&id={$data['id']}\">แก้ไข</a> |
				<a href=\"form.php?action=delete&id={$data['id']}\">ลบ</a>
			</td>";
			
	//คอลัมน์ต่อๆไปเป็นข้อมูล
	for($i = 0; $i < $num_fields; $i++) {
		echo "<td>".$data[$i]."</td>";
	}
	echo "</tr>";
}

echo "</table>";
echo "</form>";
mysqli_close($link);
?>
</body>
</html>