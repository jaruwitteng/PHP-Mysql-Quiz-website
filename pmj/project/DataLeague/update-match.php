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

	#tab1 table {
		width: auto;
		border-collapse: collapse;
		margin-top: 5px;
	}
	#tab1 table #c1 {
		width: 240px;
	}
	#tab1 table #c2 {
		width: 140px;
	}
	#tab1 table #c3 {
		width: 140px;
	}
	#tab1 table #c4 {
		width: 140px;
	}
	#tab1 table #c5 {
		width: 50px;
	}
	#tab1 table th {
		background: green;
		color: yellow;
		padding: 5px;
		border-right: solid 1px white;
	}
	#tab1 table td {
		padding: 3px;
		border-right: solid 1px white;
	}
	#tab1 table tr.row-form {
		background: #bfb  !important;
	}
	#tab1 table tr:nth-of-type(odd) {
		background: lavender;
	}
	#tab1 table tr:nth-of-type(even) {
		background: whitesmoke;
	}
	[type=date] {
		width: 120px;
	}
	[type=time] {
		width: 90px;
	}
	[name=remark] {
		width: 130px;
	}
	td select {
		width: 130px;
	}
	td button {
		text-align: center;
		width: 40px;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#tabs').tabs({active:0}); 	//ให้เปิดแท็บแรก
	$('#tabs').css('border', 'none');
	$('#tabs a').click(function(event) { 		//เมื่อคลิกแท็บใด ให้โหลดเนื้อหาของแท็บนั้นมาแสดง
		window.location = $(this).attr('href');
	});

	$('#select-league').change(function() {   //เมื่อเลือกลีก
		$('#tab1 table tbody').html(''); 			  //ลบส่วนเนื้อหาของตารางทิ้งไป
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
	
		var lg = $('#select-league option:selected').val();   //ตรวจสอบลีกที่เลือก
		 $.ajax({																//อ่านรายการแข่งขันที่กำหนดเอาไว้แล้วมาแสดง
			 url: 'update-match-get.php',
			 type: 'get',
			 data: {league: lg}, 
			 dataType: 'html',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังโหลดข้อมูล...</h3>'});
			},
			success: function(result) {
				$('#tab1 table tbody').html(result);		//ผลลัพธ์ส่งกลับมาในแบบตารางอยู่แล้ว จึงนำไปกำหนดให้กับส่วนเนื้อหาของตารางได้เลย
			},
			complete: function() {
				$.unblockUI();
			}			 
		});
	});
	
	$(document).on('click', '#add-match', function(event) {   //เมื่อคลิกปุ่มเพิ่มรายการแข่งขัน (ใช้ on เพราะปุ่มถูกเพิ่มมาทีหลัง)
		if($('#club-home option:selected').val() ==  $('#club-away  option:selected').val()) {
			alert('ทีมคู่แข่งขันเป็นทีมเดียวกัน กรุณาแก้ไข');
			return;
		}
		$.ajax({
			 url: 'update-match-set.php',
			 type: 'post',
			 data: $('#tab1 form').serializeArray(), 
			 dataType: 'script',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				$('#select-league').change();   //
			},
			complete: function() {
				$.unblockUI();
			}			 
		});		
	});

	$(document).on('click', 'button.delete-match', function(event) {   //เมื่อคลิกปุ่มเพิ่มรายการแข่งขัน (ใช้ on เพราะปุ่มถูกเพิ่มมาทีหลัง)
		if(!confirm('ยืนยันการลบโปรแกรมแข่งขันคู่นี้')) {
			return;
		}
		var id = $(this).attr('data-id');
		$.ajax({
			 url: 'update-match-del.php',
			 type: 'post',
			 data: {'match_id': id}, 
			 dataType: 'script',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				$('#select-league').change();   
			},
			complete: function() {
				$.unblockUI();
			}			 
		});		
	});
	
});

function isLeagueSelected() {
	var select =  $('#select-league option:selected');
	if(select.index() == 0 ) {  //ถ้าไม่ได้เลือกลีกใดๆ
		return false;
	}
	return true;
}
</script>
</head>

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
    	<li><a href="#tab1">อัปเดตโปรแกรมการแข่งขัน</a></li>
        <li><a href="update-result.php">อัปเดตผลการแข่งขัน</a></li>
        <li><a href="update-new-season.php">อัปเดตฤดูกาลใหม่</a></li>
        <li><a href="update-club.php">อัปเดตสโมสร</a></li>
     </ul>
	<div id="tab1">
    <form>
 		<select name="league" id="select-league">
 			<option value="">เลือกลีก</option>
                <?php
					include_once "leagues.php";
					for($i = 0; $i < count($leagues); $i++) {
						echo "<option value=\"{$leagues[$i][0]}\">{$leagues[$i][1]}</option>";
					}
				?>
 		</select> 
 		<span class="table-caption">คู่ที่แสดงในตารางคือคู่ทียังไม่อัปเดตผลการแข่งขัน</span>
           
	<table>
		<colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"><col id="c5"></colgroup>
	<thead>
	<tr><th>วันและเวลาที่เริ่มแข่ง *</th><th>ทีมเจ้าบ้าน</th><th>ทีมเยือน</th><th>การรับชม</th><th>คำสั่ง</th></tr>
	</thead>
	<tbody> </tbody>
	</table><br>* วันและเวลาที่เริ่มแข่งกำหนดด้วยอิลิเมนต์ของ HTML5 ดังนั้นหากเบราเซอร์ที่ท่านใช้อยู่ในขณะนี้ไม่รองรับ ให้เปลี่ยนไปใช้ Chrome หรือ Opera
	</form> 
	</div>  		<!-- end #tab1 -->
</div>   		<!-- end tabs -->

</td><td id="aside"><?php include "aside.php"; ?></td></tr>
<tr><td id="footer" class="text-center"><?php include "footer.php"; ?></td><td>&nbsp;</td></tr>
</table>
</body>
</html>