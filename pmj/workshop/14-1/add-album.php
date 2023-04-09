<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 14-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
		min-width: 400px;
	}
	form {
		width: 400px;
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
	input[type=file] {
		width: 90%;
		margin: 3px 3px 3px 20px;
	}
	input[type=text] {
		width: 50%;
		margin: 3px 3px 3px 20px;
		font-size: 12px;
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
	button:hover {
		color: aqua;
	}
	h3 {
		text-align: center;
	}
	h3.err {
		color: red;
	}
	label {
		display: inline-block;
		margin: 0px 0px 10px 20px;
		font-size: 12px !important;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$a = stripslashes($_POST['album']);
	//สร้างโฟลเดอร์ชื่อ "album" (ถ้ายังไม่มี) เพื่อจัดเก็บอัลบั้มทั้งหมดไว้ในนี้
	@mkdir("album");  
	
	 //สร้างโฟลเดอร์สำหรับอัลบั้มที่กำหนด
	//โดยให้วางซ้อนไว้ในโฟลเดอร์ album เช่น album/flower 
	if(mkdir("album/$a")) {
		echo "<h3>สร้างอัลบั้มใหม่เรียบร้อยแล้ว</h3>";
	}
	else {
			echo '<h3 class="err">เกิดข้อผิดพลาดในการสร้างอัลบั้ม กรุณาตรวจสอบ</h3>';
	}
}
?>
<form method="post">
	<div id="top">สร้างอัลบั้มใหม่</div>
    <input type="text" name="album" placeholder="ระบุชื่ออัลบั้ม" maxlength="150" required><br>
	<div id="bottom">
    	<button id="back" type="button" onclick="location='index.php'">หน้าหลัก</button>
        <button type="button" onclick="location='add-image.php'">เพิ่มรูปภาพ</button>
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
</body>
</html>