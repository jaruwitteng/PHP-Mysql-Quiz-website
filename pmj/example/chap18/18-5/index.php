<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');
$html = "";
$fonts = array("garuda", "norasi", "kinnari", "loma", "purisa", "sawasdee", 
 					  "tlwg-typewriter", "tlwg-typist", "tlwg-typo", "umpush", "waree");
foreach($fonts as $f) {
	$html .= "<h2 style=\"font-family:$f;\">ฟอนต์ชนิด $f</h2>";
}
pdf_html($html);
pdf_echo();
?>

 
