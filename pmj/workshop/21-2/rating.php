<?php
sleep(2);

include "dblink.php";

$item_id = $_POST['item_id'];
$star = $_POST['num_star'];

$ip = fake_ip();  //$_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO rating_star VALUES
			('$item_id', '$ip', '$star')";
$rs = mysqli_query($link, $sql);
if(mysqli_affected_rows($link) == 0) {
	echo "ข้อมูลไม่ถูกบันทึก เนื่องจากท่านเคยให้ดาวรายการนี้ไปแล้ว";
}
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