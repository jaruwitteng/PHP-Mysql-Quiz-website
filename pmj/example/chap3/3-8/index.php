<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 3-8</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	h3 {
		margin: 0px;
	}
</style>
</head>

<body>
<?php
$symbols = array(":(("=>"cry", ":))"=>"laugh", ":)"=>"happy", ":("=>"sad","X("=>"angry", ":-S"=>"worry", ":P"=>"tongue", ":D"=>"biggrin", 
 							";)"=>"wink",  ":x"=>"love", ":-B"=>"nerd", ":-*"=>"kiss", ":-/"=>"confuse", ":-O"=>"surprise", "(:|"=>"yawn");
						 
$msg = "ลืมเรื่องราวที่ทำคุณต้องเสียใจ :(:-S ร้องให้ :(( 
 			 จงยิ้มและหัวเราะเยาะมัน :):):D:D:)):)) <br>
			 เด็กเนิร์ดคนนี้ :-B:-O  พร้อมเป็นกำลังใจให้คุณเสมอ :P;)
			  รักนะจุ๊บจุ๊บ :-*:x:x:-* <br>... (:|(:| ราตรีสวัสดิ์ (:|(:| ...";
			 
echo "<h3>ข้อความเดิม</h3>$msg<hr>";

foreach($symbols as $s =>$i) {
	//นำค่าของสัญลักษณ์นั้นมากำหนดเป็นชื่อภาพ
	$img = "<img src=\"emoticons/$i.gif\">";  //ทุกภาพเป็นชนิด gif
	
	//นำแท็ก <img> ไปแทนที่สัญลักษณ์นั้น
	$msg = str_replace($s, $img, $msg);
}
echo "<h3>ข้อความหลังแทนที่</h3>$msg";
?>
</body>
</html>