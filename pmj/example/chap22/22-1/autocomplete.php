<?php
	$p = trim($_GET['term']);  //ให้ใช้คีย์เป็นคำว่า 'term' เท่านั้น
	if(empty($p)) {
		exit;
	}
	$link = mysqli_connect("localhost", "root", "abc456", "pmj");
	$sql = "SELECT *  FROM autocomplete 
				WHERE product_name LIKE '%$p%'";
	
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		//อ่านข้อมูลผลลัพธ์มาสร้างเป็นอาร์เรย์ของ PHP
		$a = array();
		while($data = mysqli_fetch_array($result)) {
			array_push($a, $data[0]);
		}
		//แปลงอาร์เรย์ของ PHP เป็น JSON แล้วส่งกลับ
		echo json_encode($a); 
	}	
	mysqli_close($link);
?>