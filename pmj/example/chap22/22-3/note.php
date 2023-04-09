<?php
	$link = mysqli_connect("localhost", "root", "abc456", "pmj");
	
	//ถ้าโพสต์ข้อความเข้ามา ให้จัดเก็บลงในตารางฐานข้อมูล
	if($_POST['note']) {
		$dt = $_POST['date'];
		$note = $_POST['note'];
		$sql = "REPLACE INTO datepicker VALUES('$dt', '$note')";
		
		$r = mysqli_query($link, $sql);
		if(!$r) {
			echo "ไม่สามารถบันทึกข้อมูลได้";
		}
		else {
			echo "บันทึกข้อมูลแล้ว";
		}
	}
	//ถ้าโพสต์มาเฉพาะวันเดือนปี ให้อ่านบันทึกจากตาราง
	else if($_POST['date'] && !$_POST['note']) {
		$dt = $_POST['date'];
		$sql = "SELECT DATE_FORMAT(dt,'%d/%m/%Y'), note 
		 			FROM datepicker  WHERE dt = '$dt'";
	
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result) > 0) {
			list($d, $n) = mysqli_fetch_row($result);
			echo "<h4>$d<br>$n</h4>";
		}
		else {
			$d = date('d/m/Y', strtotime($_POST['date']));
			echo "<h3>ไม่มีบันทึกของวันที่ $d</h3>";
			
		}
	}	
	mysqli_close($link);
	sleep(1);
?>