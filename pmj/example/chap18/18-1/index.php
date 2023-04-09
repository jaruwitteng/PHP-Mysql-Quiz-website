<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');

$html = '
		<h2 style="color:red;">สร้างเอกสาร PDF ด้วยไลบรารี ThaiPDF</h2>
		<div style="font-size:16px; color:blue;">ลักษณะที่น่าสนใจของไลบรารี ThaiPDF คือ</div>
			<ul style="list-style-type:square;">
				<li>กำหนดนื้อหาของเอกสารจาก HTML/CSS แล้วแปลงไปเป็น PDF</li>
				<li>รองรับฟอนต์ภาษาไทยโดยอัตโนมัติ</li>
				<li>ใช้งานง่าย เพราะอยู่ในรูปแบบฟังก์ชั่น</li>
			</ul>
 		<i>ท่านสามารถดาวน์โหลดไลบรารี ThaiPDF ได้ที่
		<a href="http://www.developerthai.com">DeveloperThai.com</a></i>
';

pdf_html($html);
pdf_echo();
?>
