<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 7-1</title>
<style>
	body {
		background: url(bg.jpg);
	}
	* {
		font: 14px tahoma;
	}
	form {
		display: inline-block;
		margin: auto;
	}
	textarea {
		width: 350px;
		height: 100px;
		background: #ffc;
		resize: none;
		overflow: auto;
		border: solid 1px gray;
		border-radius: 3px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 2px 10px;
		float: right;
		margin-bottom: 3px;
	}
	label {
		display: inline-block;
		padding-top: 7px;
		font-size: 16px !important;
	}
	div {
		background: #ffc;
		padding: 3px;		
	}
	h3 {
		margin-bottom: 2px;
		color: brown;
	}
</style>
</head>

<body>
<?php
if($_POST) {
	$msg = $_POST['msg'];
	
	$msg = stripslashes($msg);
	
	//ป้องกันการใส่แท็ก HTML 
	$msg = htmlspecialchars($msg, ENT_QUOTES);
	
	//แปลง \n ให้เป็น <br>
	$msg = nl2br($msg);
	
	echo "<h3>ข้อความก่อนการแทนที่:</h3>
	 		<div>$msg</div>";
	
	$pattern_url = "/(http(s?):\/\/)([a-z0-9\-]+\.)+[a-z]{2,4}(\.[a-z]{2,4})*(\/[^ ]+)*/i";

	$replace_pattern = '<a href="\\0">\\0</a>';
	
 	$msg = preg_replace($pattern_url, $replace_pattern, $msg);

	$pattern_email = "/[a-z]([a-z0-9_\.])+([a-z0-9])+@([a-z0-9\-]+\.)+([a-z]{2,4})(\.[a-z]{2,4})*/i";

	$replace_pattern = '<a href="mailto:\\0">\\0</a>';
	
 	$msg = preg_replace($pattern_email, $replace_pattern, $msg);
	
	echo "<h3>ข้อความหลังการแทนที่:</h3>
	 		<div>$msg</div>";
			
	//หลังแสดงผล ปิดเพจแล้วหยุดการทำงานในส่วนที่เหลือ
	exit("</body></html>");
}
?>
<form method="post">
	<button>ส่งข้อมูล</button>
	<label>ข้อความ</label><br>
    <textarea name="msg"></textarea>
</form>
</body>
</html>