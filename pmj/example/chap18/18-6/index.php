<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');
ob_start();
?>
<html>
<head>
<style>
	body { font-family: kinnari; font-size: 16px;}
	h1 { font-family: waree; font-size: 25px; text-align: center; color: blue;}
	#html-css { float: left; margin-right: 20px; }
</style>
</head>
<body>
<div style="text-align:center;">
	<img src="pdf-logo.jpg" width="100">
	<h1>แปลงเอกสาร HTML/CSS ให้เป็น PDF</h1>
</div>
<p>
	<img id="html-css" src="html5-css3.png" width="100">
	ในปัจจุบันเราได้เปลี่ยนแนวทางการสร้าง PDF แบบออนไลน์ใหม่ โดยจะกำหนดโครงร่างและจัดวางเนื้อหาต่างๆโดยใช้แท็ก HTML แล้วปรับแต่งรูปแบบด้วย CSS เหมือนกับการสร้างเว็บเพจ 
    จากนั้นจึงค่อยแปลงไปเป็นเอกสาร PDF อีกที  วิธีนี้จึงช่วยให้เราสร้าง PDF ได้ง่ายและสะดวกรวดเร็วกว่าแบบเดิมมาก 
</p>
</body>
</html>
<?php
$html = ob_get_clean();
pdf_html($html);
pdf_echo();
?>