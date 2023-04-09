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
		width: 90%;
		margin: 3px 3px 3px 20px;
	}
	input[type=text] {
		width: 90%;
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
		margin: 0px 0px 10px 20px;
		font-size: 12px !important;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

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
		$tmp_name = $_FILES['file']['tmp_name'];
		$size = $_FILES['file']['size'];
		$detail = $_POST['file_detail'];
		
		$accept = array("image", "video", "audio");
		
		$t = explode("/", $mime_type);
		$type = $t[0];
		
		if(!in_array($type, $accept)) {
			echo '<span class="err">ต้องเป็นไฟล์ภาพ, เสียง หรือวิดีโอเท่านั้น</span>';
			mysqli_close($link);
			exit("</body></html>");
		}
		@mkdir($type); //ถ้ายังไม่มีไดเร็กทอรี ให้สร้างขึ้นใหม่
		
		$target = "$type/$name";
		$newname  = $name;
		if(file_exists($target)) {
			$oldname = pathinfo($name, PATHINFO_FILENAME);
			$ext =  pathinfo($name, PATHINFO_EXTENSION);
		
			$newname = $oldname;
			do {
				$r = rand(1000, 9999);
				$newname = $oldname."-".$r.".$ext";	//เช่น bird-1234.jpg
				$target = "$type/$newname";
			} while(file_exists($target));
		}
		
		move_uploaded_file($_FILES['file']['tmp_name'], $target);
 
		$sql = "INSERT INTO fileshare VALUES(
					'', '$newname', '$detail', '$mime_type',  '$size', 0)";
		
		mysqli_query($link, $sql);
		echo "<h3>จัดเก็บไฟล์เรียบร้อยแล้ว</h3>";
	}
}
mysqli_close($link);
?>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดไฟล์</div>
    <label>ต้องเป็นไฟล์ภาพ, เสียง หรือวิดีโอเท่านั้น และมีขนาดไม่เกิน 2 MB</label><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 
    <input type="file" name="file" accept="image/*|video/*|audio/*" required><br><br>
    <input type="text" name="file_detail" placeholder="ลักษณะและคำสำคัญเกี่ยวกับไฟล์นี้ *" maxlength="250" required><br>
	<div id="bottom">
    	<button id="back" type="button" onclick="location='index.php'">หน้าหลัก</button>
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
</body>
</html>