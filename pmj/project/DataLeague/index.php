<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data League</title>
<style>
	@import "global.css";

	#tabs table {
		width: auto;
		border-collapse: collapse;
		margin-top: 5px;
	}
	#tabs table td {
		vertical-align: middle;
	}
	#tab1 table #t1c1 {
		width: 150px;
	}
	#tab1 table #t1c2 {
		width: 200px;
	}
	#tab1 table #t1c3 {
		width: 200px;
	}
	#tab1 table #t1c4 {
		width: 150px;
	}
	
	#tab2 table #t2c1 {
		width: 140px;
	}
	#tab2 table #t2c2 {
		width: 250px;
	}
	#tab2 table #t2c3 {
		width: 100px;
	}
	#tab2 table #t2c4 {
		width: 250px;
	}
	#tab3 table th {
		width:  40px;	
	}
	#tab3 table th:nth-child(2) {
		width:  250px !important;	
	}
	#tabs table th {
		background: green;
		color: yellow;
		padding: 5px;
		border-right: solid 1px white;
	}
	#tabs table td {
		padding: 3px;
		border-right: solid 1px white;
	}
	#tabs table tr:nth-of-type(odd) {
		background: lavender;
	}
	#tabs table tr:nth-of-type(even) {
		background: whitesmoke;
	}
	caption {
		text-align: right;
		margin-bottom: 5px;
	}
	caption a {
		color: blue !important;
		text-decoration: none;
	}
	caption a:hover {
		color: red !important;
	}
	img.logo {
		width: 24px;
		height: 24px;
		margin-right: 5px;
		vertical-align: middle;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script>
$(function() {
	<?php
		$tab = 0;
		if(isset($_GET['tab'])) {
			$tab = $_GET['tab'];
		}
	?>
	$('#tabs').tabs({active:<?php echo $tab; ?>});
	$('#tabs').css('border', 'none');
});
</script>
</head>
<?php
$lg = "pm";

if(isset($_GET['league'])) {
	$lg =  $_GET['league'];
}
include_once "leagues.php";
$src = "images/football.png";
$league = "";
for($i = 0; $i < count($leagues); $i++) {
	if($lg == $leagues[$i][0]) {
		$src = $leagues[$i][2];
		$league = $leagues[$i][1];
		break;
	}
}
?>
<body>
<table id="container">
<caption id="header">Data League</caption>
<tr>
<td id="article">
<div id="top">
	<img src="<?php echo $src; ?>"><?php echo $league ; ?>
</div>
<div id="tabs">
<ul>
    <li><a href="#tab1">โปรแกรมการแข่งขัน</a></li>
    <li><a href="#tab2">ผลการแข่งขัน</a></li>
    <li><a href="#tab3">ตารางคะแนน</a></li>
</ul>

<div id="tab1">
<table border="0" id="t1">
<caption><a href="javascript:alert('Do It Yourself')">ดูโปรแกรมการแข่งขันทั้งหมด</a></caption>
<colgroup><col id="t1c1"><col id="t1c2"><col id="t1c3"><col id="t1c4"></colgroup>
<tr><th>วันและเวลาที่เริ่มแข่ง</th><th>ทีมเจ้าบ้าน</th><th>ทีมเยือน</th><th>การรับชม</th></tr>
<?php
include "dblink.php";
$sql = "SELECT * FROM matches 
	 		WHERE (league = '$lg') AND (home_goals IS NULL) AND (away_goals IS NULL) 
			ORDER BY match_datetime DESC LIMIT 100";
	
$result = mysqli_query($link, $sql);
while($match = mysqli_fetch_array($result)) {
	$date = thai_datetime($match['match_datetime']);
	$home = read_club_info($match['home_id']);
	$away = read_club_info($match['away_id']);
	
	$home_name = $home[0];
	$home_logo = $home[1];
	
	$away_name = $away[0];
	$away_logo = $away[1];
?>
<tr>
	<td><?php echo $date; ?></td>
    <td><img src="<?php echo $home_logo; ?>" class="logo"><?php echo $home_name; ?></td>
    <td><img src="<?php echo $away_logo; ?>" class="logo"><?php echo $away_name; ?></td>
    <td><?php echo $match['watch']; ?></td>
</tr>
<?php
}
?>
</table>
</div>  <!-- end #tab1 -->

<div id="tab2">
<table border="0" id="t2">
<caption><a href="javascript:alert('Do It Yourself')">ดูผลการแข่งขันทั้งหมด</a></caption>
<colgroup><col id="t2c1"><col id="t2c2"><col id="t2c3"><col id="t2c4"></colgroup>
<tr><th>วันที่แข่ง</th><th>ทีมเจ้าบ้าน</th><th>ผล</th><th>ทีมเยือน</th></tr>
<?php
$sql = "SELECT * FROM matches 
	 		WHERE (league = '$lg') AND (home_goals IS NOT NULL) AND (away_goals IS NOT NULL)	
			ORDER BY match_datetime DESC LIMIT 100";
			
$result = mysqli_query($link, $sql);
while($match = mysqli_fetch_array($result)) {
	$date = thai_datetime($match['match_datetime'], false);		
	$home = read_club_info($match['home_id']);
	$away = read_club_info($match['away_id']);
	
	$home_name = $home[0];
	$home_logo = $home[1];
	
	$away_name = $away[0];
	$away_logo = $away[1];
	
	$home_goals = $match['home_goals'];
	$away_goals = $match['away_goals'];
?>
<tr>
	<td><?php echo $date; ?></td>
    <td><img src="<?php echo $home_logo; ?>" class="logo"><?php echo $home_name; ?></td>
    <td class="text-center"><?php echo $home_goals . " - " . $away_goals; ?></td>
    <td><img src="<?php echo $away_logo; ?>" class="logo"><?php echo $away_name; ?></td>
</tr>
<?php
}
?>
</table> 
</div>  <!-- end #tab2 -->

<div id="tab3">
<table border="0" id="t3">
<colgroup><col id="t3c1"><col id="t3c2"><col id="t3c3"><col id="t3c4"><col id="t3c5"><col id="t3c6"><col id="t3c7"><col id="t3c8"><col id="t3c9"><col id="t3c10"></colgroup>
<tr><th>ลำดับ</th><th>สโมสร</th><th>แข่ง</th><th>ชนะ</th><th>เสมอ</th><th>แพ้</th><th>ได้</th><th>เสีย</th><th>ผลต่าง</th><th>คะแนน</th></tr>
<?php
$sql = "SELECT * FROM clubs 
	 		WHERE (league = '$lg') ORDER BY points DESC, goals_diff DESC";
$result = mysqli_query($link, $sql);
$pos = 1;
while($club = mysqli_fetch_array($result)) {
	if(empty($club['logo'])) {
		$club['logo'] = "images/football.png";
	}
?>
<tr>
	<td class="text-center"><?php echo $pos; ?></td>
	<td><img src="images/logo-club/<?php echo $club['logo']; ?>" class="logo"><?php echo $club['club_name']; ?></td>
    <td class="text-center"><?php echo $club['played']; ?></td>
 	<td class="text-center"><?php echo $club['won']; ?></td>
 	<td class="text-center"><?php echo $club['drawn']; ?></td>
 	<td class="text-center"><?php echo $club['lost']; ?></td>    
    <td class="text-center"><?php echo $club['goals_for']; ?></td>  
    <td class="text-center"><?php echo $club['goals_against']; ?></td>  
    <td class="text-center"><?php echo $club['goals_diff']; ?></td>  
 	<td class="text-center"><?php echo $club['points']; ?></td>      
</tr>
<?php
	$pos++;
}
mysqli_close($link);
?>
</table> 
</div>  <!-- end #tab3 -->

</div>   <!-- end #tabs -->
<?php
function read_club_info($id) {
	global $link;
	$sql = "SELECT club_name, logo FROM clubs WHERE club_id = $id";
	$res = mysqli_query($link, $sql);
	$club = mysqli_fetch_array($res);
	if(empty($club['logo'])) {
		$club['logo'] = "images/football.png";
	}
	else {
		$club['logo'] = "images/logo-club/" . $club['logo'];
	}
	return array($club['club_name'], $club['logo']);
}
						
function thai_datetime($datetime, $show_time=true) {
 	$th_months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
	 							"กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$dt = explode(" ", $datetime);
	$d = explode("-", $dt[0]);

	$date = ltrim($d[2], "0");  //ตัดเลข 0 ข้างหน้าออก
	$month = ltrim($d[1], "0");
	$result =  $date . "  " . $th_months[$month] . "  " . ($d[0] + 543);
	if($show_time) {
		$tm = explode(":", $dt[1]);
		$result .= "  (" . $tm[0] . ":" . $tm[1] . ")";
	}
	return $result;
}
?>
<br>
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