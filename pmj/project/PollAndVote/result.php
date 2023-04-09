<?php
include "dblink.php";

$topic_id = $_POST['topic_id'];
/*
$ip =   $_SERVER['REMOTE_ADDR'];
$sql = "SELECT * FROM poll_ip WHERE ip = '$ip'";
$rs = mysqli_query($link, $sql);
if(mysqli_num_rows($rs) == 0) {
	echo "IP: $ip ไม่เคยโหวตโพลหัวข้อนี้ จึงไม่สามารถดูผลลัพธ์ได้";
	mysqli_close($link);
	exit;
}
*/

$sql = "SELECT SUM(score) FROM poll_choice WHERE topic_id = '$topic_id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);
$voters = $data[0];

$sql = "SELECT * FROM poll_choice WHERE topic_id = '$topic_id' ORDER BY score DESC";
$rs = mysqli_query($link, $sql);
while($data = mysqli_fetch_array($rs)) {
	echo $data['choice_text'] . " (".$data['score'].")<br>";
	if($voters == 0) { 
		echo "<br>";
		continue;
	}
	$p = intval(100*($data['score']/$voters));
	echo '<div class="graph" style="width:'.$p.'px;background:'.$data['graph_color'].'"></div>';
	echo "<br>";
}

mysqli_close($link);
?>