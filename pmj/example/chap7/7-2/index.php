<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 7-2</title>
<style>
	body {
		background: url(bg.jpg);
		font: 14px tahoma;
	}
	h3 {
		margin: 2px;
	}
	b {
		color: brown;
	}
</style>
</head>

<body>
<?php
$str1 = "Regular Expression หรือ RegEx เป็นวิธีการตรวจสอบข้อมูลที่เริ่มใช้ในภาษา Perl 
 	 	 	แต่ปัจจุบันภาษาคอมพิวเตอร์อื่นๆ เช่น PHP, .NET, JavaScript ก็ได้นำรูปแบบของ RegEx ไปใช้ด้วย";

//ค้นหาคำว่า "regex" หรือ "regular expression"
$find_pattern = "/(regex)|(regular expression)/i";

/* \\0 ใช้อ้างถึงสตริงที่ตรงกับทั้งแพตเทิร์น หรือตรงกับทุก Sub Pattern รวมกันนั่นเอง   */
$replace_pattern = "<b>\\0</b>";
$str2 = preg_replace($find_pattern, $replace_pattern, $str1);
			
echo "<h3>สตริงก่อนการแทนที่:</h3>
 	 	 $str1
 	 	<hr>
 	 	<h3>สตริงหลังการแทนที่:</h3>
 	 	 $str2";
?>
</body>
</html>