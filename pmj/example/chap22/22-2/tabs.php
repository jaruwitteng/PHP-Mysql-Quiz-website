<?php
	$tab = $_GET['tab'];
	if($tab == "tab1") {
		echo "jQuery เป็นไลบรารี(Library) หรือชุดคำสั่งที่เขียนด้วยภาษาจาวาสคริปต์ 
				เพื่อช่วยให้การเขียนสคริปต์ควบคุมและจัดการอิลิเมนต์ต่างๆนั้นง่ายขึ้นและ
				รวดเร็วกว่าการเขียนด้วยจาวาสคริปต์โดยตรงมาก...";
	}
	else if($tab == "tab2") {
		//รายละเอียดของไลบรารี IMGallery อยู่ในบทที่ 14
		include "../../../lib/IMGallery/imgallery-no-jquery.php";
		gallery_thumb_height(60);
		gallery_echo_dir('pics/');
	}
	sleep(2);  //ทดลองหน่วงเวลา 2 วินาที
?>