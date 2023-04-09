<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 13-2</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
		min-width: 350px;
	}
	form {
		width: 350px;
		text-align: left;
		margin: auto;
		background: #bcb;
	}
	div {
		background: #dd9;
		padding: 3px 0px;
	}
	div#top {
		border-bottom: solid 1px #999;
		font-size: 16px;
		color: green;
		margin-bottom: 20px;
		padding: 5px;
	}
	div#bottom {
		display: inline-block;
		border-top: solid 1px #999;
		margin-top: 20px;
		width: 100%;
		padding: 5px 0px;
	}
	input {
		width: 90%;
		margin: 3px 3px 3px 20px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
	}
	button#submit {
		float: right;
		margin-right: 5px;
	}
	br.clear {
		clear: right;
	}
	button:hover {
		color: aqua;
	}
	table {
		border-collapse: collapse;
		margin: auto;
		margin-top: 20px;
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
		max-width: 300px;
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
	span.err {
		color: red;
		font-size: 16px;
		display: block;
		margin-top: 20px;
		text-align: center;
	}
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดไฟล์</div>
    <input type="hidden" name="MAX_FILE_SIZE" value="100000"> <!-- ประมาณ 100 KB -->
    <input type="file" name="file" accept="image/*">
	<div id="bottom">
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
<?php
if($_FILES) {
	$e = $_FILES['file']['error'];
	
	//ถ้าเป็นเลขที่ไม่ใช่ 0 แสดงว่าเกิดข้อผิดพลาด
	if($e != 0) {  
		$msg = "";
		if($e == 1) {
			$msg = "ไฟล์ที่อัปโหลดมีขนาดเกินกว่าขนาด upload_max_filesize (".ini_get("upload_max_filesize").")";
		}
		else if($e == 2) {
			$max = round($_POST['MAX_FILE_SIZE'] /1000);  //โดยประมาณเท่านั้น ความจริงต้องหารด้วย 1024
			$msg = "ไฟล์ที่อัปโหลดมีขนาดเกินกว่าค่า  MAX_FILE_SIZE (".$max." KB)";
		}
		else if($e == 3) {
			$msg = "ไฟล์ถูกอัปโหลดมาไม่ครบ";
		}
		else if($e == 4) {
			$msg = "ไม่มีไฟล์อัปโหลดมา";
		}
		else {
			$msg = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
		}
		
		echo '<span class="err">'.$msg.'</span>';
	}
	else {	
		echo "<table><caption>ข้อมูลของไฟล์ที่อัปโหลด</caption>";
		echo "<tr><th>ข้อมูล</th><th>ค่า</th></tr>";
		echo "<tr><td>name</td><td>" . $_FILES['file']['name'] . "</td></tr>";
		echo "<tr><td>type</td><td>" . $_FILES['file']['type'] . "</td></tr>";
		echo "<tr><td>size</td><td>" . $_FILES['file']['size'] . "</td></tr>";
		echo "<tr><td>tmp_name</td><td> " . $_FILES['file']['tmp_name'] . "</td></tr>";
		echo "<tr><td>error</td><td>" . $_FILES['file']['error'] . "</td></tr>";
		
		$type = $_FILES['file']['type'];
		$t = explode("/", $type);
		if($t[0]=="image") {
			$size = getimagesize($_FILES['file']['tmp_name']);
			$width = $size[0];
			$height = $size[1];
			echo "<tr><td>Dimension(w x h)</td><td>$width x $height</td></tr>";
		}
		
		echo "<table>";
	}
}
?>
</body>
</html>