<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 12-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
		min-width: 600px;
	}
	form {
		width: 550px;
		text-align: left;
		margin: auto;
		background: #cdc;
	}
	div {
		background: #dd9;
		padding: 3px 0px;
	}
	div#top {
		border-bottom: solid 1px #999;
		font-size: 16px;
		color: green;
		margin-bottom: 10px;
		padding: 5px;
		border-radius: 4px 4px 0px 0px;
	}
	div#bottom {
		display: inline-block;
		border-top: solid 1px #999;
		margin-top: 10px;
		width: 100%;
		border-radius: 0px 0px 4px 4px;
		padding: 5px 0px;
	}
	img {
		margin: 3px 3px 3px 20px;
	}
	input, textarea {
		background: #ffd;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 3px;
		margin: 3px 3px 3px 20px;
	}
	input {
		width: 500px;
	}
	textarea {
		width: 500px;
		height: 80px;
		resize: none;
		overflow: auto;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
	}
	button#back {
		margin-left: 5px;
	}
	button#submit {
		float: right;
		margin-right: 5px;
	}
	br.clear {
		clear: right;
	}
</style>
</head>

<body>
<?php
if($_POST) {
 	$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 				or die(mysqli_connect_error()."</body></html>");
				
	$title = $_POST['title'];
	$content = $_POST['content'];
	$url = $_POST['url'];
	
	$sql = "INSERT INTO sitesearch VALUES('', '$title', '$url', '$content')";
	$r = mysqli_query($link, $sql);
	if($r) {
		echo "<h3>เพิ่ม URL ลงในฐานข้อมูลแล้ว</h3>";
	}
	mysqli_close($link);
}
?>
<form method="post">
  <div id="top">เพิ่ม URL สำหรับการสืบค้น</div>
	<input type="text" name="title" placeholder="ชื่อเพจ (Title)" required>  <br>
    <textarea name="content" placeholder="สรุปเนื้อหา ให้ครอบคลุมคำสำคัญทั้งหมดในเพจ"></textarea><br>
    <input type="text" name="url" placeholder="url ของเพจ...ต้องขึ้นต้นด้วย http:// หรือ https://" required>   <br>
<div id="bottom">
	<button id="back" type="button" onclick="location='index.php'">ย้อนกลับ</button>
	<button id="submit">ส่งข้อมูล</button><br class="clear">
</div>
</form>
</body>
</html>