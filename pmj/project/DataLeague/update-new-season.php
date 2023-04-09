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

	#tab3 img {
		float: left;
		width: 36px;
		margin-right: 5px;
	}
	#tab3 h3 {
		color: green;
	}
	
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#tabs').tabs({active:2});
	$('#tabs').css('border', 'none');
	$('#tabs a').click(function(event) {
		window.location = $(this).attr('href');
	});
	
	$('#bt-clear').click(function() {
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
		
		var lg = $('#select-league option:selected').val(); 
		var txt = $('#select-league option:selected').text();
		if(!confirm('ยืนยันการลบข้อมูลของลีก: '  +  txt )) {
			return;
		}
		
		 $.ajax({
			 url: 'update-new-season-set.php',
			 type: 'post',
			 data: {league: lg}, 
			 dataType: 'script',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังอัปเดตข้อมูล...</h3>'});
			},
			success: function(result) {
				
			},
			complete: function() {
				$.unblockUI();
			}			 
		 });
	 });
	 
	$('#bt-update-club').click(function() {
		location = 'update-club.php';
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
        <li><a href="#tab3">อัปเดตฤดูกาลใหม่</a></li>
        <li><a href="update-club.php">อัปเดตสโมสร</a></li>
     </ul>
	<div id="tab3">
     
     <h3>
     		<img src="images/play.png">
     		สิ่งที่ต้องทำเมื่อเริ่มต้นฤดูกาลใหม่ของแต่ละลีก<br>
             <select id="select-league">
        	<option value="">เลือกลีก</option>
             <?php
				include_once "leagues.php";
				for($i=0; $i < count($leagues); $i++) {
					echo "<option value=\"{$leagues[$i][0]}\">{$leagues[$i][1]}</option>";
				}
			?>
 		</select>
     </h3>
     
     
     <h4>
     		<img src="images/minus.png">
     		ลบข้อมูลเกี่ยวกับการแข่งขันในฤดูกาลที่แล้วทิ้งไป เนื่องจากเราจะเก็บเฉพาะข้อมูลของฤดูกาลปัจจุบันเท่านั้น<br>
        <button type="button" id="bt-clear">ลบข้อมูลของลีกที่เลือก</button>
     </h4>
     <h4>
     		<img src="images/x.png">
     		ลบสโมสรที่ตกชั้นออกไป และเพิ่มสโมสรใหม่ที่ได้เลื่อนชั้นขึ้นมา<br>
     		<button type="button" id="bt-update-club">อัปเดตข้อมูลสโมสร</button>
     </h4>
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