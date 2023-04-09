<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 13-4</title>
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
	h3 {
		text-align: center;
	}
	img {
		margin: 10px;
		max-width: 100px;
		max-height: 80px;
		border-radius: 5px;
	}
 </style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

if(is_uploaded_file($_FILES['file']['tmp_name'])) {
	if($_FILES['file']['error'] != 0) {
		echo "File Uploaded Error!";
	}
	else {	
		$file = $_FILES['file']['tmp_name'];
		$content = addslashes(file_get_contents($file));
		$name = $_FILES['file']['name'];
		$type = $_FILES['file']['type'];

 		$sql = "INSERT INTO files VALUES
 		 			('', '$name', '$type', '$content');";

		mysqli_query($link, $sql);
		echo "<h3>จัดเก็บไฟล์เรียบร้อยแล้ว</h3>";
	}
}
?>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดไฟล์ (เฉพาะรูปภาพ ไม่เกิน 60 KB)</div>
    <input type="hidden" name="MAX_FILE_SIZE" value="65535">
    <input type="file" name="file" accept="image/*" required>
	<div id="bottom">
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
<h3>รายการไฟล์ที่เก็บในฐานข้อมูล (ไม่ใช่ขนาดจริง)</h3>
<?php
$sql = "SELECT file_id FROM files";
$rs = mysqli_query($link, $sql);
while($file = mysqli_fetch_array($rs)) {
	echo "<img src=\"read-img.php?id={$file['file_id']}\">";
}
mysqli_close($link);
?>

</body>
</html>