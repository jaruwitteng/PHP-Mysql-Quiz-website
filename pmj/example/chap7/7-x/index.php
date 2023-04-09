<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 7-3</title>
<style>
	* {
		font: 14px tahoma;
	}
	form {
		display: inline-block;
		margin: auto;
	}
	textarea {
		width: 400px;
		height: 80px;
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
		background: #dfd; 
		padding: 3px;		
	}
	h3 {
		margin-bottom: 2px;
		color: brown;
	}
	iframe {
		border: 0px;
		margin: 5px auto;
		width: 400px;
		height: 300px;
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
	
	$pattern_youtube =  '/(http(s)*\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)(\/.+)([a-z0-9\-_]{11})/i';
	$replace_pattern = '<iframe width="400" height="300" src="http://www.youtube.com/embed/\\6" frameborder="0" allowfullscreen></iframe>';
	$msg = preg_replace($pattern_youtube, $replace_pattern, $msg);

	
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