<?php	session_start();  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article & Comment</title>
<style>
	@import "global.css";
	article {
		text-align: center;
	}
	form#new-member {
		width: 500px;
		padding: 5px;
		background: #e5f5d5;
		display: inline-block;
	}
	form#new-member * {
		margin-bottom: 3px;
	}
	form#new-member [type=text], form#new-member [type=email], form#new-member [type=password] {
		width: 250px;
		font-size: 14px;
		padding: 3px;
		border: solid 1px gray;
	}
	form#new-member #col1, form#new-member #col2 {
		float: left;
		margin: 5px 10px 5px 5px;
		text-align: left;
	}
	form#new-member #col1 img {
		height: 80px;
		margin-top: 5px;
	}
	form#new-member [name=captcha] {
		width: 150px !important;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	$('#file').change(function() {
		if(this.files[0].size > 51200) {
			alert('ไฟล์ภาพมีขนาดใหญ่เกินกำหนด (50 KB) กรุณาเปลี่ยนใหม่');
			$(this).replaceWith($(this).clone());
		}
	});
	
	$('#ok').click(function() {
		if($('[name=pswd]').val() !== $('[name=pswd2]').val()) {
			alert('ใส่รหัสผ่านทั้งสองช่องไม่ตรงกัน');
			return;
		}
		
		$('form#new-member').submit();
	});
})
</script>
</head>
<body>
<?php  include "header-nav.php"; ?>
<div id="container">
<?php
include "logo-banner.php"; 
$page_title = "สมัครสมาชิก";
include "breadcrumbs.php"; 
?>
<article>
<?php
if($_POST) {
	
	
}
?>
<form id="new-member" method="post">    
	<div id="col1">
    	<img src="images/profile.jpg"> 
    </div>
    <div id="col2">
        <input type="hidden" name="MAX_FILE_SIZE" value="51200">
    เลือกภาพประจำตัว: <br><input type="file" name="photo" id="profile" accept="image/*"><br>
 	<input type="text" name="name" placeholder="ชื่อผู้ใช้ *" required><br>
   <input type="email" name="login" placeholder="อีเมล์ (สำหรับเป็น Login) *" required><br>
    <input type="password" name="pswd" placeholder="รหัสผ่าน *" required><br>
   <input type="password" name="pswd2" placeholder="ใส่รหัสผ่านซ้ำ *" required><br>
	<br>

    <label></label>
	<?php 	
	include "lib/AntiBotCaptcha/abcaptcha.php";
	//captcha_bg_color("lavender");
	captcha_echo(); 
	?><br>
   <input type="text" name="captcha" placeholder="อักขระในภาพ *" required>
    <br><br>
    
    	<button type="button" id="cancel">ยกเลิก</button> 
     	<button type="button" id="ok">ตกลง</button>
	</div>
</form>
</article>

<?php include "aside.php"; ?>
<?php include "footer.php"; ?>
</div>
</body>
</html>
<?php @mysqli_close($link); ?>