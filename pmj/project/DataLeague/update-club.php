<?php 
session_start();
if(!isset($_SESSION['admin'])) {
	header("location: login.php");
	exit;
}
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data League</title>
<style>
	@import "global.css";
	#form-add-club {
		display: none;
	}
	#form-add-club input {
		font-size: 14px;
		margin-top: 10px;
	}
 	#form-add-club input[name=club] {
		width: 300px;
	}
	span.club {
		width: 300px;
		display: inline-block;
		padding: 3px;
		margin-top: 10px;
		font-size: 14px;
		font-weight: bold;
		color: brown;
	}
	span.club button {
		font-size: 12px;
	}
	span.club img {
		float: left;
		width: 48px;
		vertical-align: top;
		margin-right: 5px;
	}
	span.club a {
		display: inline-block;
		font-size: 12px;
		margin: 3px 2px 0px 0px;
		color: blue;
		border: solid 0px orange;
		background: none;
		padding: 2px;
		border-radius: 3px;
		text-decoration: none;
	}
	span.club a:hover {
		background: none;
		color:red;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#tabs').tabs({active:3});
	$('#tabs').css('border', 'none');
	$('#tabs a').click(function(event) {
		window.location = $(this).attr('href');
	});
		
	 $('#select-league').change(function() {
		$('p#list-club').html(''); 
		var lg = $('#select-league option:selected').val();   //อ่านค่าลีกที่เลือก
		 $.ajax({
			 url: 'update-club-get.php',
			 type: 'get',
			 data: {league: lg}, 
			 dataType: 'html',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังโหลดข้อมูล...</h3>'});
			},
			success: function(result) {
				$('p#list-club').html(result);  //ข้อมูลส่งกลับมาในแบบ HTML
			},
			complete: function() {
				$.unblockUI();
				$('#form-add-club').dialog("close");
			}			 
		 });
	 });
	 
	$('button#add-club').click(function() {   //เมื่อคลิกปุ่มเพิ่มสโมสรที่อยู่ข้างๆ select
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
		var select =  $('#select-league option:selected');
		$('#form-add-club')[0].reset();
		$('#form-add-club').dialog({
			title: 'เพิ่มสโมสรใน: ' + select.text(),
			width: 350,
			modal: true,
			position: { my: "left top", at: "left bottom", of: $(this)}
		});
		$(this).focus();
	});
	
	$('#bt-add-club-ok').click(function() {   //เมื่อคิกปุ่ม OK ที่อยู่ในไดอะล็อก
		var lg = $('#select-league option:selected').val();
		$('#form-add-club [name=league]').val(lg);
		$('#form-add-club').ajaxForm({
			url: 'update-club-set.php',
			type: 'post',
			dataType: 'script',
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			}, 
			complete: function() {
				$.unblockUI();
				$('#form-add-club').dialog("close");
				 $('#select-league').change();  	//หลังเพิ่มข้อมูล ทำให้เกิดอีเวนต์ change ที่ <select> โดยอัตโนมัติ
				 												//เพื่อให้โหลดรายชื่อสโมสรมาแสดงใหม่
			}
		});
	});
	
	//ใช้ $(document).on(...) เพราะ <a> ไม่ได้สร้างขึ้นพร้อมกับเพจ แต่ถูกนำมาเติมในภายหลัง
	$(document).on('click', 'span.club a:contains(ลบ)', function(event) {
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
		var club = $(this).attr('data-club');
		var league = $('#select-league option:selected').text();
		if(!confirm('ยืนยันการลบสโมสร: ' + club + '\nออกจาก: ' +  league)) {
			return;
		}
		
		var lg = $('#select-league option:selected').val();
		var clubID = $(this).attr('data-id');
		$.ajax({
			 url: 'update-club-del.php',
			 type: 'post',
			 data: {'league': lg, 'club_id': clubID}, 
			 dataType: 'html',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังอัปเดตข้อมูล...</h3>'});
			},
			success: function(result) {
				$('#select-league').change();
			},
			complete: function() {
				$.unblockUI();
			}			 
		 });
	});

	$(document).on('click', 'span.club a:contains(แก้ไข)', function() {
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
		var select =  $('#select-league option:selected');
		$('#form-add-club').dialog({
			title: 'แก้ไขสโมสร : ' + $(this).attr('data-club'),
			width: 350,
			modal: true,
			position: { my: "left top", at: "left bottom", of: $(this)}
		});
		$(this).focus();
	});		
});

function isLeagueSelected() {
	var select =  $('#select-league option:selected');
	if(select.index() == 0 ) {
		return false;
	}
	return true;
}
</script>
</head>
<?php 
include_once "leagues.php";
?>
<body>
<table id="container">
<caption id="header">Data League</caption>
<tr>
<td id="article">
<div id="top">
	<img src="images/football.png">Update Data
</div>
<div id="tabs">
	<ul>
    	<li><a href="update-match.php">อัปเดตโปรแกรมการแข่งขัน</a></li>
        <li><a href="update-result.php">อัปเดตผลการแข่งขัน</a></li>
        <li><a href="update-new-season.php">อัปเดตฤดูกาลใหม่</a></li>
        <li><a href="#tab4">อัปเดตสโมสร</a></li>
     </ul>
     <div id="tab4">         
          	<select id="select-league">
        		<option value="">เลือกลีก</option>
                <?php
					include_once "leagues.php";
					for($i=0; $i < count($leagues); $i++) {
						echo "<option value=\"{$leagues[$i][0]}\">{$leagues[$i][1]}</option>";
					}
				?>
			</select>
            <button type="button" id="add-club">&laquo; เพิ่มสโมสรในลีกที่เลือก</button>
            &nbsp;&nbsp ลบสโมสรที่ตกชั้นออกไป และเพิ่มสโมสรใหม่ที่ได้เลื่อนชั้นขึ้นมา
            
       <!-- ฟอร์มนี้จะถูกซ่อนเอาไว้ จะแสดงเมื่อเปิดไดอะล็อกเท่านั้น -->    
       	<form id="form-add-club" method="post" enctype="multipart/form-data">  
        	<input type="text" name="club" placeholder="ชื่อสโมสร *" required>
      	 	<input type="file" name="logo"> <br>* ภาพโลโก้ของสโมสร<br><br>
		 	<button type="submit" id="bt-add-club-ok">ตกลง</button>  
            <input type="hidden" name="league">
        </form>       
       <p id="list-club"></p>        
     </div>

</div>
</td>
<td id="aside">
<?php include "aside.php"; ?>
</td>
</tr>
<tr>
<td id="footer" class="text-center">
<?php include "footer.php"; ?>
</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>