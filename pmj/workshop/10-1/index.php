<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 10-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 600px;
	}
	fieldset {
		width: 500px;
		margin: auto;
		background: powderblue;
		border-radius: 4px
	}
	form {
		display: inline-block;
		width: auto;	
		margin: auto;
		text-align: left;
	}
	form > * {
		margin: 5px 0px 0px 0px;
	}
	textarea {
		width: 400px;
		height: 80px;
		resize: none;
		overflow: auto;
		float: left;
	}
	label {
		display: inline-block;
		width: 80px;
		float: left;
	}
	.clear {
		clear: left;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 2px 10px;
		float: right;
		margin-top: 10px;
	}
	select, textarea {
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 3px;
	}
	table {
		border-collapse: collapse;
		margin: auto;
		min-width: 200px;
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
$link = @mysqli_connect("localhost", "root", "abc456")
 			or die(mysqli_connect_error()."</body></html>");

$sql = "SHOW DATABASES";
$rs = mysqli_query($link, $sql);
?>
<fieldset>
<form method="post">
	<label>ฐานข้อมูล: </label>
	<select name="db">
<?php
	while($db = mysqli_fetch_array($rs)) {
		echo "<option value=\"{$db[0]}\"";
		if($_POST['db'] == $db[0]) {
			echo " selected";
		}
		echo ">{$db[0]}</option>";
	}
?>
	</select>
<br>
<label>คำสั่ง SQL:</label>
<textarea name="sql"><?php echo stripslashes($_POST['sql']); ?></textarea>
<br class="clear">
<button>ส่งข้อมูล</button>
</form>
</fieldset><br>

<?php
if($_POST) {
	$db = $_POST['db'];
	mysqli_select_db($link, $db);
	
	$sql = stripslashes($_POST['sql']);
	$result = @mysqli_query($link, $sql);
	if(!$result) {
		echo mysqli_error($link);
		end_page();
	}
	
	//ถ้าข้อมูลจำนวนแถวไม่ใช่ตัวเลข แสดงว่าเป็นคำสั่งประเภทการเปลี่ยนแปลงข้อมูล
	if(!is_numeric(@mysqli_num_rows($result))) {
		//ถ้าเป็นคำสั่งการเปลี่ยนแปลงขอมูล ให้แสดงเป็นจำนวนแถวที่เกิดการเปลี่ยนแปลง
		$affected_rows = 0;
		if(is_numeric(@mysqli_affected_rows($link))) {	
			$affected_rows = mysqli_affected_rows($link);
		}
		echo  "Query OK, " . $affected_rows . " row(s) affected";
		end_page();
	}
	else {
		//ถ้าจำนวนแถวเป็นตัวเลข แสดงว่าเป็นคำสั่งการเลือกข้อมูล ให้แสดงจำนวนแถวผลลัพธ์ก่อน
		$msg = "Query OK, " . mysqli_num_rows($result) . " row(s) in set";
	}
	
	//อ่านข้อมูลใน result set มาแสดงในแบบตาราง HTML
	echo "<table><caption>$msg</caption>";
			 
	if(mysqli_num_rows($result) == 0) {  //ถ้าไม่มีผลลัพธ์
		echo "</table>";
		end_page();
	}
	//อ่านชื่อฟิลด์มาแสดงเป็นส่วนหัวของตาราง
	echo "<tr>"; 
	$num_fields = mysqli_num_fields($result);
	for($i = 0; $i < $num_fields; $i++) {
		$field = mysqli_fetch_field_direct($result, $i);
		echo "<th>" . $field->name . "</th>";
	}
	echo "</tr>";

	//แสดงส่วนที่เป็นข้อมูลในตาราง
	while($data = mysqli_fetch_array($result)) {
		echo  "<tr>";
		for($i = 0; $i < $num_fields; $i++) {
			echo "<td>" .  $data[$i] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

function end_page() {
	@mysqli_close($link);
	exit("</body></html>");
}
?>
</body>
</html>
<?php @mysqli_close($link); ?>