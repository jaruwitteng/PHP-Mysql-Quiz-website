<?php
include "dblink.php";

$topic_id = $_POST['topic_id'];
$choice_id = $_POST['choice_id'];
$ip = fake_ip();  //$_SERVER['REMOTE_ADDR'];

$sql = "SELECT * FROM poll_ip WHERE ip = '$ip'";
$rs = mysqli_query($link, $sql);
if(mysqli_num_rows($rs) != 0) {
	echo "IP: $ip ได้โหวตโพลหัวข้อนี้ไปแล้ว ไม่สามารถโหวตซ้ำได้อีก";
	mysqli_close($link);
	exit;
}

$sql = "UPDATE poll_choice SET score = score + 1 WHERE choice_id = '$choice_id'";
mysqli_query($link, $sql);

$sql = "INSERT INTO poll_ip VALUES('$topic_id', '$ip')";
mysqli_query($link, $sql);

echo "โหวตโพลหัวข้อนี้แล้ว";
mysqli_close($link);

//-------------------------------------------------------------------------
function fake_ip() {
	$a = array();
	//สุ่มให้ได้เลขระหว่าง 0-255 จำนวน 4 ชุด
	for($i = 1; $i <= 4; $i++) {
		$n = rand(0, 255);
		array_push($a, $n);
	}
	$ip = implode(".", $a);   //นำเลขแต่ละชุดมาเชื่อมต่อกันด้วยจุด
	return $ip;
}

?>