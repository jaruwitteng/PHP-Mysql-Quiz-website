<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');

$html = '<div style="font-family:purisa; font-size:50px; text-align:center;">';
for($i=1; $i<=50; $i++) {
	$html .= "$i<br>";
}
$html .= "</div>";

pdf_pagenum_text("หน้า: ", "");
pdf_pagenum_font("green","sawasdee", 16, "ITALIC");
pdf_pagenum_position("TOP", "LEFT", "RIGHT");
pdf_pagenum_line("dotted", 1, "brown");

pdf_html($html);
pdf_echo();
?>