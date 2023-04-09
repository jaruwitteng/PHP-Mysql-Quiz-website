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

	#tab2 table {
		width: auto;
		border-collapse: collapse;
		margin-top: 5px;
	}
	#tab2 table #c1 {
		width: 150px;
	}
	#tab2 table #c2 {
		width: 140px;
	}
	#tab2 table #c3 {
		width: 100px;
	}
	#tab2 table #c4 {
		width: 140px;
	}
	#tab2 table #c5 {
		width: 110px;
	}
	#tab2 table #c6 {
		width: 70px;
	}
	#tab2 table th {
		background: green;
		color: yellow;
		padding: 5px;
		border-right: solid 1px white;
	}
	#tab2 table td {
		padding: 3px;
		border-right: solid 1px white;
	}
	#tab2 table tr:nth-of-type(odd) {
		background: lavender;
	}
	#tab2 table tr:nth-of-type(even) {
		background: whitesmoke;
	}
	[type=number] {
		width: 30px;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#tabs').tabs({active:1});
	$('#tabs').css('border', 'none');
	$('#tabs a').click(function(event) {
		window.location = $(this).attr('href');
	});
		
	 $('#select-league').change(function() {
		$('#tab2 table tbody').html(''); 
		if(!isLeagueSelected()) {
			alert('กรุณาเลือกลีก');
			return;
		}
		
		var lg = $('#select-league option:selected').val(); 
		 $.ajax({
			 url: 'update-result-get.php',
			 type: 'get',
			 data: {league: lg}, 
			 dataType: 'html',
			 beforeSend: function() {
				$.blockUI({message:'<h3>กำลังโหลดข้อมูล...</h3>'});
			},
			success: function(result) {
				$('#tab2 table tbody').html(result);
			},
			complete: function() {
				$.unblockUI();
			}			 
		 });
	 });
	 
	 $(document).on('click', 'button.update', function(event) {
		var matchId = $(this).attr('data-match-id');
		var homeId = $(this).attr('data-home-id');
		var awayId = $(this).attr('data-away-id');
		var homeGoals = $('#'+homeId).val();
		var awayGoals = $('#'+awayId).val();
		
		if(!$.isNumeric(homeGoals) || !$.isNumeric(awayGoals)) {
			alert('กรุณาใส่จำนวนประตูเป็นตัวเลขให้ครบทั้ง 2 ทีม');
		 	return;
		}
		var lg = $('#select-league option:selected').val(); 
		
		var dat = {league:lg, match_id: matchId, home_id: homeId, away_id: awayId, home_goals:homeGoals, away_goals: awayGoals};
		
		 $.ajax({
			 url: 'update-result-set.php',
			 type: 'post',
			 data: dat, 
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
	if(select.index() == 0 ) {
		return false;
	}
	return true;
}
</script>
</head>
<?php 

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
        <li><a href="#tab2">อัปเดตผลการแข่งขัน</a></li>
        <li><a href="update-new-season.php">อัปเดตฤดูกาลใหม่</a></li>
        <li><a href="update-club.php">อัปเดตสโมสร</a></li>
     </ul>
	<div id="tab2">
    <form>
    	    <select id="select-league">
        		<option value="">เลือกลีก</option>
                <?php
					include_once "leagues.php";
					for($i=0; $i < count($leagues); $i++) {
						echo "<option value=\"{$leagues[$i][0]}\">{$leagues[$i][1]}</option>";
					}
				?>
			</select>
            <span class="table-caption">แสดงเฉพาะคู่ที่ยังไม่อัปเดตผลการแข่งขัน (ต้องกำหนดโปรแกรมการแข่งขันก่อนจึงจะอัปเดตผลคู่นั้นได้)</span>
<table border="0">
<colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"><col id="c5"><col id="c6"></colgroup>
<thead>
<tr><th>วันและเวลาที่เริ่มแข่ง</th><th>ทีมเจ้าบ้าน</th><th>ผล</th><th>ทีมเยือน</th><th>การรับชม</th><th>คำสั่ง</th></tr>
</thead>
<tbody>

</tbody>
</table>
</form> 
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