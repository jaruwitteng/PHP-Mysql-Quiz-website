<?php
sleep(1);
include "dblink.php";
if($_POST) {
	$action = $_POST['action'];
	$id = $_POST['id'];
	
	if($action == "active") {
		//เนื่องจากเรากำหนดว่าจะมีโพลเพียงหัวข้อเดียวที่ active
		//ดังนั้นหากเป็นการสั่งให้ให้ active จะต้องยกเลิกสถานะของโพลเดิมที่ active 
		//ให้เป็น inactive เสียก่อน แล้วค่อยเซตสถานะโพลหัวข้อที่กำหนดเป็น active
		$sql = "UPDATE poll_topic SET status = 'inactive'";
		mysqli_query($link, $sql);
		
		$sql = "UPDATE  poll_topic SET status = 'active' WHERE topic_id = '$id'";
		mysqli_query($link, $sql);
	}
	else if($action == "inactive") {	
		$sql = "UPDATE  poll_topic SET status = 'inactive' WHERE topic_id = '$id'";
		mysqli_query($link, $sql);
	}
	else if($action == "delete") {
		//ถ้าเป็นการสั่งลบ จะต้องลบข้อมูลที่เกี่ยวข้องกับโพลหัวข้อนั้นในทุกตาราง
		$sql = "DELETE FROM  poll_topic WHERE topic_id = '$id'";
		mysqli_query($link, $sql);	

		$sql = "DELETE FROM  poll_choice WHERE topic_id = '$id'";
		mysqli_query($link, $sql);
		
		$sql = "DELETE FROM  poll_ip WHERE topic_id = '$id'";
		mysqli_query($link, $sql);	
	}
	
	mysqli_close($link);
}
?>