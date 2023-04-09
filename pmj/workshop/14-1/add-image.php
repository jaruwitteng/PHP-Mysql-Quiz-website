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
		width: 500px;
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
		margin: 3px 0px;
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
	span.err {
		color: red;
		font-size: 16px;
		display: block;
		margin-top: 20px;
		text-align: center;
	}
	h3 {
		text-align: center;
	}
	label {
		display: inline-block;
		width: 120px;
		margin: 0px 0px 10px 20px;
		font: bold 12px tahoma !important;
	}
</style>
</head>

<body>
<?php
if(is_uploaded_file($_FILES['file']['tmp_name'])) {
	$e = $_FILES['file']['error'];
	
	//ถ้าเป็นเลขที่ไม่ใช่ 0 แสดงว่าเกิดข้อผิดพลาด
	if($e != 0) { 
		$msg = "";	
		if($e == 1 || $e == 2) {
			$msg = "ไฟล์ที่อัปโหลดมีขนาดเกินกำหนด";
		}
		else {
			$msg = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
		}
		echo '<span class="err">'.$msg.'</span>';
	}
	else {
		$mime_type = $_FILES['file']['type'];
		$name = $_FILES['file']['name'];
							
		$t = explode("/", $mime_type);
		$type = $t[0];
		
		if($type != "image") {
			echo '<span class="err">ต้องเป็นไฟล์ภาพเท่านั้น</span>';
			exit("</body></html>");
		}
		
		$a =  $_POST['album'];
	
		$target = "album/$a/$name";
		$newname  = $name;
		if(file_exists($target)) {
			$oldname = pathinfo($name, PATHINFO_FILENAME);
			$ext =  pathinfo($name, PATHINFO_EXTENSION);
		
			$newname = $oldname;
			do {
				$r = rand(1000, 9999);
				$newname = $oldname."-".$r.".$ext";	//เช่น bird-1234.jpg
				$target = "album/$a/$newname";
			} while(file_exists($target));
		}
		
		move_uploaded_file($_FILES['file']['tmp_name'], $target);
		echo "<h3>จัดเก็บไฟล์เรียบร้อยแล้ว</h3>";
	}
}
?>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดไฟล์</div>
     <label>จัดเก็บในอัลบั้ม:</label>
    <select name="album">
    <?php
		$a = "album";  //โฟลเดอร์ album ที่สร้างไว้ในขั้นตอนของเพจ add-album.php
		$d = opendir($a);
		while($dir = readdir($d)) {
			if($dir == "." || $dir == ".." || is_file($dir)) {
				continue;
			}
			else {
				$selected = "";
				if($dir == $_POST['album']) {
					$selected = " selected";
				}
				echo "<option value=\"$dir\"$selected>$dir</option>";	
			}
		}
		closedir($d);
	?>
    </select><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576"> 
    <label>เลือกไฟล์ <br>(ขนาดไม่เกิน 1 MB):</label>
    <input type="file" name="file" accept="image/*" required><br>
	<div id="bottom">
    	<button id="back" type="button" onclick="location='index.php'">หน้าหลัก</button>
        <button type="button" onclick="location='add-album.php'">เพิ่มอัลบั้ม</button>
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
</body>
</html>