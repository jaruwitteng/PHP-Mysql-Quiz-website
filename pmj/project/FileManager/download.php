<?php
include "check-login.php";

if($_GET['path']) {
	$path = $_GET['path'];
	if(file_exists($path)) {
		$info = pathinfo($path);
		$basename = $info['basename'];
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$basename");
		header("Content-Transfer-Encoding: binary");
 		readfile("$path");
	}
	exit;
}
?>