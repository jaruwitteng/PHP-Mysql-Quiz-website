<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 13-1</title>
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
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดไฟล์</div>
    <input type="file" name="file" required>
	<div id="bottom">
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
<?php
if($_FILES) {  //ถ้ามีอินพุทชนิด file ส่งเข้ามา
	echo "<table><caption>ข้อมูลของไฟล์ที่อัปโหลด</caption>";
	echo "<tr><th>ข้อมูล</th><th>ค่า</th></tr>";
	echo "<tr><td>name</td><td>" . $_FILES['file']['name'] . "</td></tr>";
	echo "<tr><td>type</td><td>" . $_FILES['file']['type'] . "</td></tr>";
	echo "<tr><td>size</td><td>" . $_FILES['file']['size'] . "</td></tr>";
	echo "<tr><td>tmp_name</td><td> " . $_FILES['file']['tmp_name'] . "</td></tr>";
	echo "<tr><td>error</td><td>" . $_FILES['file']['error'] . "</td></tr>";
	echo "</table>";
}
?>
</body>
</html>