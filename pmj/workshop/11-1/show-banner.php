<?php
$link_banner= mysqli_connect("localhost", "root", "abc456", "pmj");

//เลือกเฉพาะ banner ที่ยังไม่สิ้นสุดกำหนดเวลาโฆษณา
$sql = "SELECT bid, filename FROM banner 
 			WHERE date_end > NOW()";
			
$rs = @mysqli_query($link_banner, $sql);
if($rs) {
	$num = mysqli_num_rows($rs);
	//สุ่มให้ได้เลขระหว่าง 0 - จำนวน banner
	$rand = rand(0, $num);
	
	//เลือก banner ในลำดับที่สุ่มได้
	mysqli_data_seek($rs, $rand);
	
	//อ่านข้อมูลของ banner ในลำดับนั้น
	$bn = mysqli_fetch_array($rs);
	$bid = $bn['bid'];
	$src = "banner/{$bn['filename']}";

	//แสดงภาพในแบบลิงก์เพื่อให้คลิกเปิดไปยังเพจปลายทางคือ click-banner.php
	//โดยแนบค่า id ในแบบ Query String ต่อท้ายไปด้วย
	//เพื่อใช้เป็นเงื่อนไขในการนับเพิ่มจำนวนคลิก และเชื่อมโยงไปเพจเจ้าของ banner
	echo "<a href=\"click-banner.php?id=$bid\" target=\"_blank\">
 		 	<img src=\"$src\" style=\"border:none\"></a>";
			
 	//เพิ่มจำนวนครั้งที่แสดง banner นั้นไปอีก 1
	$sql = "UPDATE banner SET views = views + 1 WHERE bid = $bid";
	mysqli_query($link_banner, $sql);
}
mysqli_close($link_banner);
?>