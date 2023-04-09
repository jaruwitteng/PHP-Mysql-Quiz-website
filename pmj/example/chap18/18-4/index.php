<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');
ob_start();
?>
<html>
<body>
<?php
	for($i=1;$i<=6;$i++) {
		echo "<h$i>ฟอนต์ขนาด h$i</h$i>";
	}
?>
</body>
</html>
<?php
$html = ob_get_clean();
pdf_html($html);
pdf_echo();
?>
