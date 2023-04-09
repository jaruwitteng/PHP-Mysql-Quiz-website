<?php
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=test.php");
header("Content-Transfer-Encoding: binary");
readfile("code.zip");		// ถ้าอ่านจากไฟล์โดยตรง
exit;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test</title>
</head>

<body>
<?php
//echo ini_get("upload_max_filesize");
?>
<form method="post" enctype="multipart/form-data">
	<input type="file">
</form>
</body>
</html>