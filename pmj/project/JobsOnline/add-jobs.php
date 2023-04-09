<?php  include "check-user.php"; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
<style>
	@import "global.css";
	form {
		width: 630px;
		padding-left: 15px;
		padding-bottom: 20px;
		margin: auto;
	}
	input[type=text], textarea {
		font-size: 16px;
		padding: 3px;
		border: solid 1px gray;
		background: #eef;
	}
	input[name=position] {
		width: 450px;
	}
	input[name=quantity] {
		width: 150px;
	}
	textarea {
		width: 613px;
		height: 50px;
		font-size: 14px !important;
		resize: none;
	}
	input[name='qualification[]'] {
		width: 613px;
		margin-bottom: 3px;
		font-size: 14px !important;
		display: block;
	}
	form div {
		width: 620px;
		margin-top: 10px;
	}
	#ok {
		float: right;
	}
	h4 {
		text-align: center;
		color: green;
	}
	h4 > img {
		vertical-align: middle;
		margin-right: 5px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	$('#add').click(function() {
		var content = '<input type="text" name="qualification[]" maxlength="200" placeholder="คุณสมบัติ">';
		if($('input[name="qualification[]"]').length < 10) {
			$('input[name="qualification[]"]:last').after(content);
		}
	});
	
	$('#add').click();
	$('#add').click();	
	
	$('#delete').click(function() {
		if($('input[name="qualification[]"]').length > 1) {
			$('input[name="qualification[]"]:last').remove();
		}
	});
});
</script>
</head>

<body>
<body><?php include "header-nav.php"; ?>
<div class="container">
<article>
<section id="title">
	<h3>เพิ่มตำแหน่งงาน</h3>
    <div>ต้องกำหนดชื่อตำแหน่งและคุณสมบัติอย่างน้อย 1 ข้อ ส่วนข้อมูลอื่นๆเป็นออปชั่น</div>
</section>
<section id="content">
<?php
if($_POST) {
	include "dblink.php";
	$pos = $_POST['position'];
	$quan =  $_POST['quantity'];
	$desc = $_POST['description'];
	
	$sql = "REPLACE INTO jobs VALUES('', '$pos', '$quan', '$desc', NOW())";
	$r1 = mysqli_query($link, $sql);
	
	$id = mysqli_insert_id($link);
	foreach($_POST['qualification'] as $qual) {
		if(empty($qual)) {
			continue;
		}
		$sql = "REPLACE INTO qualification VALUES('', '$id', '$qual')";
		$r2 = mysqli_query($link, $sql);
	}
	
	echo '<h4><img src="images/ok.png"> จัดเก็บข้อมูลเรียบร้อยแล้ว กรุณาใส่ตำแหน่งถัดไป หรือไปยังหน้าหลัก</h4>';
	mysqli_close($link);
}
?>
<form method="post">
	<input type="text" name="position" maxlength="150" placeholder="ตำแหน่งงาน*" required>
	<input type="text" name="quantity" maxlength="50" placeholder="อัตราที่รับ"><br><br>
    <textarea name="description" placeholder="รายละเอียดของงาน"></textarea><br><br>
 	<input type="text" name="qualification[]" maxlength="250" placeholder="คุณสมบัติ*" required>
    <div>
    	<button type="button" id="add">เพิ่มคุณสมบัติ</button>
        <button  type="button" id="delete">ลดคุณสมบัติ</button>
        <button type="reset" id="cancel">ลบข้อมูล</button>
        <button type="submit" id="ok">ส่งข้อมูล</button>
    </div>
</form>
</section>
</article>

<aside> <?php include "side-menu.php"; ?></aside>
</div>
<?php include "footer.php";  ?>
</body>
</html>