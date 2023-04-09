<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');
ob_start();
?>
<html>
<head>
<style>
	h2 { color:red; }
	#dv { font-size:16px; color:blue; }
	ul.square { list-style-type:square; }
</style>
</head>
<body>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<h2>สร้างเอกสาร PDF ด้วยไลบรารี ThaiPDF</h2>
	<div id="dv">ลักษณะที่น่าสนใจของไลบรารี ThaiPDF คือ</div>
	<ul class="square">
		<li>กำหนดนื้อหาของเอกสารจาก HTML/CSS แล้วแปลงไปเป็น PDF</li>
		<li>รองรับฟอนต์ภาษาไทยโดยอัตโนมัติ</li>
		<li>ใช้งานง่าย เพราะอยู่ในรูปแบบฟังก์ชั่น</li>
	</ul>
 	<i>ท่านสามารถดาวน์โหลดไลบรารี ThaiPDF ได้ที่
	<a href="http://www.developerthai.com">DeveloperThai.com</a></i>
</body>
</html>
<?php
$html = ob_get_clean();
pdf_watermark_text("ตัวอย่าง", "sawasdee", 0.3);
pdf_html($html);
pdf_echo();
?>