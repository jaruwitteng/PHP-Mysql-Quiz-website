<?php  
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
<style>
	@import "global.css";
	form {
		padding-left: 15px;
		padding-bottom: 30px;
	}
	input[type=text], textarea {
		font-size: 14px;
		padding: 3px;
		border: solid 1px gray;
		background: #eef;
		margin: 5px 0px 0px;
	}
	input[name=name] {
		font-size: 16px !important;
		width: 382px !important;
	}
	input[name=age] {
		font-size: 16px !important;
		width: 50px !important;
	}
	input.w450 {
		width: 450px;
	}
	input.w216 {
		width: 216px;
	}
	input.w350 {
		width: 350px;
	}
	input.w200 {
		width: 200px;
	}
	input.w100 {
		width: 100px;
	}
	input.w562 {
		width: 562px;
	}
	textarea {
		width: 450px;
		height: 50px;
		resize: none;
	}
	div#left {
		float: left;
		width: 480px;
	}
	div#right {
		float: left;
	}
	div.section {
		width: 685px;
		border-bottom: dotted 1px gray;
		font-weight: bold;
		font-size: 16px;
		color: green;
	}
	input[disabled] {
		color: gray;
		border-color: white !important;
	}
	input[name=expect_jobs] {
		width: 463px !important;
	}
	br.clear { clear: both; }
	div#bottom {
		width: 96%;
	}
	form hr {
		width: 95%;
		margin-left: 0px;
	}
	form div#bottom {
		padding-top: 20px;
		width: 90%;
	}
	form div#bottom img {
		float: left;
		margin-right: 5px;
	}
	form button#submit {
		float: right;
		padding: 5px 20px;
		font-size: 16px;
		font-weight: bold;
		color: aqua;
		background: #C00;
		border: solid 2px skyblue;
		border-radius: 4px;
	}
	form button#submit:hover {
		color: yellow;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.form.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('#submit').click(function() {
		$('form').ajaxForm({
			url: 'save-resume.php',
			type: 'post',
			dataType: 'script',
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			}, 
			complete: function() {
				$.unblockUI();
			}
		});
	});
	
});
</script>
</head>
<body><?php include "header-nav.php"; ?>
<div class="container">

<article>
<section id="title">
	<h3>เขียน Resume</h3>
	<div>ต้องใส่ข้อมูลทุกช่องที่มีเครื่องหมาย * กรุณาเขียนให้กระชับ ความยาวไม่ควรเกินความกว้างของแต่ละช่อง</div>
</section>
<section id="content">
<form method="post" enctype="multipart/form-data">
	<div id="left">
	<input type="text" name="name" maxlength="150" placeholder="ชื่อ-นามสกุล *" class="w450" required>&nbsp;
    <input type="text" name="age" placeholder="อายุ *" required>
    <br>
    <textarea name="address" placeholder="ที่อยู่  *" required></textarea>
    <br>
    <input type="text" name="phone" placeholder="โทรศัพท์  *"  class="w216" required>&nbsp;
    <input type="text" name="email" placeholder="อีเมล์  *"  class="w216">
    </div>
    <div id="right">
    	<img src="images/photo.jpg" height="95"><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="65000">
    	<input type="file" name="photo" accept="image/jpeg;image/gif;image/png"><br>
     </div>
    <br class="clear"><br>
    
    <div class="section">ตำแหน่งงานและเงินเดือนที่คาดหวัง</div>
    <input type="text" name="expect_jobs" placeholder="ลักษณะหรือตำแหน่งงานที่สนใจ  *"  class="w562" required>
    <input type="text" name="salary" placeholder="เงินเดือนที่ต้องการ  *"  class="w200" required>
         
     <br><br>
    <div class="section">ประวัติการทำงาน (เริ่มจากครั้งล่าสุด)</div>
    <input type="text" name="exp_position[0]" placeholder="ตำแหน่ง"  class="w200">
    <input type="text" name="exp_place[0]" placeholder="สถานที่ทำ"  class="w350">
    <input type="text" name="exp_period[0]" placeholder="ระยะเวลา"  class="w100">
    <br>
    <input type="text" name="exp_position[1]" placeholder="ตำแหน่ง"  class="w200">
    <input type="text" name="exp_place[1]" placeholder="สถานที่ทำ"  class="w350">
    <input type="text" name="exp_period[1]" placeholder="ระยะเวลา"  class="w100">
    <br>
     <input type="text" name="exp_position[2]" placeholder="ตำแหน่ง"  class="w200">
    <input type="text" name="exp_place[2]" placeholder="สถานที่ทำ"  class="w350">
    <input type="text" name="exp_period[2]" placeholder="ระยะเวลา"  class="w100">
  
    <br><br>
    <div class="section">ประวัติการศึกษา (เริ่มจากระดับชั้นสูงสุด)</div>
    <input type="text" name="edu_level[0]" placeholder="ระดับการศึกษา  *"  class="w100" required>
    <input type="text" name="edu_major[0]" placeholder="สาขาวิชา  *"  class="w200" required>
    <input type="text" name="edu_academy[0]" placeholder="สถาบัน  *"  class="w350" required>
    <br>
    <input type="text" name="edu_level[1]" placeholder="ระดับการศึกษา"  class="w100">
    <input type="text" name="edu_major[1]" placeholder="สาขาวิชา"  class="w200">
    <input type="text" name="edu_academy[1]" placeholder="สถาบัน"  class="w350">
    <br>
    <input type="text" name="edu_level[2]" placeholder="ระดับการศึกษา"  class="w100">
    <input type="text" name="edu_major[2]" placeholder="สาขาวิชา"  class="w200">
    <input type="text" name="edu_academy[2]" placeholder="สถาบัน"  class="w350">
   
    <br><br>
    <div class="section">ความรู้ ความสามารถ</div>
    <input type="text" value="ภาษาที่รู้"  class="w100" disabled>
    <input type="text" name="lang" placeholder="ระบุ *"  class="w562" required>
    <br>
    <input type="text" value="คอมพิวเตอร์"  class="w100" disabled>
    <input type="text" name="comp" placeholder="ระบุ *"  class="w562" required>
    <br>
    <input type="text" value="ความสามารถอื่นๆ"  class="w100" disabled>
    <input type="text" name="other_skill" placeholder="ระบุ"  class="w562">
    <br>
    <input type="text" value="การขับขี่"  class="w100" disabled>
   	<input type="checkbox" name="driving" value="yes">สามารถขับรถยนต์ได้ &nbsp;&nbsp;
    <input type="checkbox" name="driving_license" value="yes">มีใบอนุญาตขับขี่รถยนต์ &nbsp;&nbsp;
    <input type="checkbox" name="own_car" value="yes">มีรถยนต์ส่วนตัว
    <hr>
    <div id="bottom">
    <?php	
		include "lib/AntiBotCaptcha/abcaptcha.php";
		captcha_bg_color("lavender");
		echo captcha_echo();
	?>
		อักขระที่ปรากฏในภาพ<br>
    	<input type="text" name="captcha" id="text-captcha" placeholder="*" required> 
    	<button type="submit" id="submit">ส่งข้อมูล</button>
    </div>    
</form>
</section>
</article>

<aside> <?php include "side-menu.php"; ?></aside>

</div><?php include "footer.php";  ?>
</body>
</html>