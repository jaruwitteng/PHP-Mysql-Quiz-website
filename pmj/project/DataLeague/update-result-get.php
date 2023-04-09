<?php
session_start();
if(!isset($_SESSION['admin'])) {
	exit;
}
if(isset($_GET['league'])) {
	include "dblink.php";
	$lg =  $_GET['league'];
	$sql = "SELECT * FROM matches 
	 			WHERE (league = '$lg') AND (home_goals IS NULL) AND (away_goals IS NULL) ORDER BY match_datetime ASC";
	$result = mysqli_query($link, $sql);
	while($match = mysqli_fetch_array($result)) {
		$date = thai_datetime($match['match_datetime']);		
		$club_home = read_club_name($match['home_id']);
		$club_away = read_club_name($match['away_id']);
?>
<tr>
	<td><?php echo $date; ?></td>
    <td><?php echo $club_home; ?></td>
    <td class="text-center">
    	<input type="number" id="<?php echo $match['home_id']; ?>" min="0"> -
        <input type="number" id="<?php echo $match['away_id']; ?>" min="0">
    </td>
    <td><?php echo $club_away; ?></td>
    <td><?php echo $match['watch']; ?></td>
    <td><button type="button" class="update"
    			data-match-id = "<?php echo $match['match_id']; ?>"
    			data-home-id="<?php echo $match['home_id']; ?>" 
                data-away-id="<?php echo $match['away_id']; ?>">อัปเดต</button>
 	</td>
</tr>
<?php
	}
	mysqli_close($link);
}
function read_club_name($id) {
	global $link;
	$sql = "SELECT club_name FROM clubs WHERE club_id = $id";
	$res = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($res);
	return $row[0];
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