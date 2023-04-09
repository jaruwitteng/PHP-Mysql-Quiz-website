<?php	
session_start(); 
//$_SESSION['admin']=1; 
if(!isset($_GET['id'])) {
	exit;
}
$comment_id = $_GET['id'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article & Comment</title>
<style>
	@import "global.css";
	article > div {
		width: 95%;
		margin-left: 10px;
	}
	br.clear {
		clear: left;
	}
	div#form-dialog {
		display: none;
	}
	#form-comment * {
		margin: 3px;
	}
	#form-comment input[type=text], #form-comment textarea {
		font-size: 14px;
		padding: 3px;
		border: solid 1px gray;
		background: #eef;
	}
	#form-comment input[name=title] {
		width: 600px;
	}
	#form-comment input[name=commentator] {
		width:250px;
	}
	#form-comment textarea {
		width: 400px;
		height: 60px;
		resize: none;
		overflow: auto;
	}
	#form-comment #col1, #form-comment #col2 {
		float: left;
	}
	#form-comment #col2 span {
		float: right;
	}
	#form-comment #abcaptcha {
		float: right;
		margin-right: 10px;
	}
	#form-comment button[type=submit] {
		float: none;
	}
	#form-comment input[name=captcha] {
		width: 190px;
	}
	a.write-comment {
		color: blue;
		text-decoration: none;
	}
	a.write-comment:hover {
		color: red;
	}
	.section-comment {
		width: 600px;
		display: inline-block;
		margin-left: 10px;
		background: #dce6f2;
		padding: 5px;
		font-size: 14px;
	}
	.section-reply {
		width: 520px;
		display: inline-block;
		margin-left: 0px;
		background: #e5f5d5;
		padding: 5px;
		font-size: 14px;
	}
	div.col-photo {
		width: 70px;
		float: left;
	}
	div.col-comment {
		width: 520px;
		float: left;
	}
	div.col-reply {
		width: 440px;
		float: left;
	}
	span.commentator {
		display: block;
		color: brown;
		font-weight: bold;
		margin-bottom: 10px;
	}
	span.image-box {
		display: inline-block;
		border: solid 1px gray;
		background: white;
		padding: 3px 3px 0px;
		margin-top: 10px;
	}
	.image-comment {
		max-width: 500px;
		max-height: 300px;
	}
	.image-reply {
		max-width: 420px;
		max-height: 300px;		
	}
	span.date-comment {
		color: gray;
		font-size: 14px;
		margin-top: 10px;
		display: block;
	}
	span.reply-alert {
		float: right;
		font-size: 14px;
	}
	span.reply-alert a, a.all-reply {
		color: blue;
		text-decoration: none;
	}
	span.reply-alert a:hover, a.all-reply:hover {
		color: red;
	}
	span.separator {
		display: block;
		height: 5px;
	}
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('.write-comment').click(function(event) {
		$('#form-comment')[0].reset();
		
		 //ปกติการคลิก <a> ทำให้เปลี่ยนหน้า และ scrollbar เลื่อนไปอยู่บนสุด
		 //จึงล็อก scrollbar ไม่ให้เลื่อน โดยการกระทำที่เป็นดีฟอลต์ของ <a>
		event.preventDefault();
		var t = "แสดงความคิดเห็น";
		if(event.target.getAttribute('data-type') == "r") {
			t = "ตอบกลับความคิดเห็น";
		}
		$('#form-dialog').dialog({
			width: '600px',
			title: t,
			modal: true,
			position: { my: "center", at: "center", of: window}  	//เป็นค่า default อยู่แล้ว
		});
		$('#link-id').val(event.target.getAttribute('data-id'));
		$('#comment-type').val(event.target.getAttribute('data-type'));
	});

	$(document).on('change', '#file', function() {
		if(this.files[0].size > 512000) {
			alert('ไฟล์ภาพมีขนาดใหญ่เกินกำหนด (500 KB) อาจมีปัญหาในการอัปโหลด กรุณาเปลี่ยนใหม่');
			$(this).replaceWith($(this).clone());
		}
	});
		
	$('#submit-comment').click(function() { 
		$('form#form-comment').ajaxForm({
			url: 'save-comment.php',
			type: 'post',
			dataType: 'script',
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			}, 
			complete: function() {
				$.unblockUI();
				window.opener.location.href = window.opener.location.href;
			}
		});	
	});
});
</script>
</head>
<body>
<?php  include "header-nav.php"; ?>
<div id="container">
<?php
include "logo-banner.php"; 
$page_title = "การตอบกลับความคิดเห็น";
include "breadcrumbs.php"; 
?>

<article>
<div id="form-dialog">
<form id="form-comment" method="post" enctype="multipart/form-data">
	<div id="col1">
    	<img src="images/profile.jpg" height="60"> 
    </div>
  	<div id="col2"> 
    <input type="text" name="commentator" placeholder="ชื่อ *" required> <br> 
    <textarea name="comment_text" placeholder="ความคิดเห็น *" required></textarea><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="512000">  
    <input type="file" name="file" id="file" accept="image/*">
   <span>[ภาพประกอบข้อคิดเห็น]</span><br><br>  
      <?php	
		include "lib/AntiBotCaptcha/abcaptcha.php";
		captcha_bg_color("lavender");
		echo captcha_echo();
	?>
    <input type="text" name="captcha" placeholder="อักขระที่ปรากฏในภาพ *" required><br>
    <button type="submit" id="submit-comment">ส่งข้อมูล</button> <br> 
    </div>
    <input type="hidden" name="link_id" id="link-id">
    <input type="hidden" name="comment_type" id="comment-type">
</form>
</div>
<?php
	include "dblink.php";
	include "lib/pagination.php";
	$sql = "SELECT * FROM comment WHERE comment_id = $comment_id AND comment_type = 'c'";
	$r1 = mysqli_query($link, $sql);
	while($cm = mysqli_fetch_array($r1)) {
		$comment_id = $cm['comment_id'];
		echo '<section class="section-comment">';
		echo '<div class="col-photo"><img src="images/profile.jpg" width="60"></div>';
		echo '<div class="col-comment">';
		echo '<span class="commentator">' .$cm['commentator'] . '</span>';
		echo $cm['comment_text'];
		if($cm['image_id'] != 0) {
			echo '<br><span class="image-box"><img src="read-image.php?id='. $cm['image_id'] . '" class="image-comment"></span>';
		}
		
		echo '<span class="date-comment">'. thai_date($cm['date_post'], true);
		echo '<span class="reply-alert">';
	
		$sql = "SELECT COUNT(*) FROM comment WHERE link_id = $comment_id AND comment_type = 'r'";
		$r2 = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($r2);
		$num_reply = $row[0];
		echo '<a href="#" class="write-comment" data-id="'.$comment_id.'" data-type="r">ตอบกลับ('. $num_reply . ')</a>&nbsp;&middot;&nbsp;';
		echo '<a href="javascript:alert(\'นำไปทดลองทำเอง\')">แจ้งลบ</a>';
		echo '</span></span>';
		
		$sql = "SELECT * FROM comment WHERE link_id = $comment_id AND comment_type = 'r' ORDER BY comment_id DESC";
		$r3 = page_query($link, $sql, 10);
		$first = true;
		while($rp = mysqli_fetch_array($r3)) {
			if($first) { 
				echo '<span class="separator"></span>';
				$first = false;
			}
			echo '<section class="section-reply">';
			echo '<div class="col-photo"><img src="images/profile.jpg" width="60"></div>';
			echo '<div class="col-reply">';
			echo '<span class="commentator">' .$rp['commentator'] . '</span>';
			echo $rp['comment_text'];
			if($rp['image_id'] != 0) {
				echo '<br><span class="image-box"><img src="read-image.php?id='. $rp['image_id'] . '" class="image-reply"></span>';
			}
		
			echo '<span class="date-comment">'. thai_date($rp['date_post'], true);
			echo '<span class="reply-alert"><a href="javascript:alert(\'นำไปทดลองทำเอง\')">แจ้งลบ</a>';
			echo '</span></span>';
			echo '</div>';
			echo '</section>';		
		}
		echo '</div>';
		echo '</section>';
		
		if(page_total() > 1) {
			echo '<p id="pagenum">';
			page_echo_pagenums();
			echo '</p>';
		}
	}

function thai_date($datetime, $include_time=false) {
	$dt = explode(" ", $datetime);
	$d = explode("-", $dt[0]);
	$th_months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
	 								"กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	
	$date = ltrim($d[2], "0");  //ตัดเลข 0 ข้างหน้าออก
	$month = ltrim($d[1], "0");
	$t = "";
	if($include_time) {
		$t = $dt[1];
	}
	return $date . "  " . $th_months[$month] . "  " . ($d[0] + 543). "  " . $t;
}
?>
</article>

<?php include "aside.php"; ?>
<?php include "footer.php"; ?>
</div>
</body>
</html>
<?php @mysqli_close($link); ?>