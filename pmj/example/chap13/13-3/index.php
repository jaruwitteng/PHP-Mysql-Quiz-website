<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 13-3</title>
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
		padding: 5px 0px;
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
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
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
		margin-left: 15px;
	}
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data">
	<div id="top">อัปโหลดและเคลื่อนย้ายไฟล์</div>
    <input type="hidden" name="MAX_FILE_SIZE" value="100000"> <!-- ประมาณ 100 KB -->
    <input type="file" name="file">
    <br><br>
    <label>กรณีไฟล์ชื่อซ้ำกัน </label>
    <input type="radio" name="exist" value="random" checked>สร้างชื่อใหม่แบบสุ่ม
    <input type="radio" name="exist" value="overwrite">เขียนทับ
	<div id="bottom">
		<button id="submit">ส่งข้อมูล</button><br class="clear">
	</div>
</form>
<?php
if(is_uploaded_file($_FILES['file']['tmp_name'])) {
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
		@mkdir("images"); //ถ้ายังไม่มีไดเร็กทอรี ให้สร้างขึ้นใหม่
		
		$target = "images/".$_FILES['file']['name'];
		if(!file_exists($target)) {
			move_uploaded_file($_FILES['file']['tmp_name'], $target);
		}
 		else {
			if($_POST['exist'] == "overwrite") {
				move_uploaded_file($_FILES['file']['tmp_name'], $target);
			}
			else {
				$oldname = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
				$ext =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				do {
					$r = rand();
					$newname = $oldname."_".$r.".$ext";	
					$target = "images/$newname";
					if(!file_exists($target)) {
						move_uploaded_file($_FILES['file']['tmp_name'], $target);
					}
				} while(file_exists($target));
			}
		}
		
		echo "<h3>จัดเก็บไฟล์เรียบร้อยแล้ว</h3>";
	}
}
?>
</body>
</html>