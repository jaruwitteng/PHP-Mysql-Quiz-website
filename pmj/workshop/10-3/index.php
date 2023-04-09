<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 10-3</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 500px;
	}
	fieldset {
		width: 450px;
		margin: auto;
		background: powderblue;
		border-radius: 4px
	}
	legend {
		text-align: left;
		font-size: 18px;
		color: green;
	}
	form {
		display: inline-block;
		width: auto;
		text-align: left;
	}	
	input, select {
		width: 200px;
	}
	textarea {
		width: 417px;
		height: 60px;
		resize: none;
		overflow: auto;
	}
	input, textarea, select {
		background: lavender;
		border: solid 1px gray;
		margin: 3px;
		padding: 3px;
		border-radius: 2px;	
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 3px 20px;
		float: right;
		margin-right: 5px;
	}
	div#msg-container {
		width: 465px;
		background: #cc9;
		border: solid 1px silver;
		border-radius: 4px;
		padding: 5px 5px 10px;	
		margin: auto;
		text-align: left;
	}
	div#msg-container > span {
		display: inline-block;
		font-size: 12px !important;
	}
	span.name b {
		font: bold 12px tahoma;
		color: green;
	}
	span.msg {
		width: 98%;
		background: #def;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 3px;
	}
	span.ago {
		float: right;
		margin-right: 4px;
	}
	br.clear {
		clear: right;
	}
	hr {
		width: 99%;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");
 
if($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	$msg = nl2br($msg);
	$type = $_POST['msg_type'];
	
	$sql = "INSERT INTO guestbook VALUES(
				'', '$name', '$email', '$msg', '$msg_type', NOW())";
	mysqli_query($link, $sql);
}
?>
<fieldset><legend>สมุดเยี่ยม</legend>
<form method="post">
	<input type="text" name="name" placeholder="ชื่อ *" required>
    <input type="email" name="email" placeholder="อีเมล"><br>
	<textarea name="msg" placeholder="ข้อความ *"></textarea><br>
    <select name="type">
    	<option value="c">แสดงความคิดเห็น</option>
    	<option value="q">ติดต่อสอบถาม</option>
    </select>
    <button>ส่งข้อมูล</button>
</form>
</fieldset><br>
<?php
include "datetime-ago.php";  //รายละเอียดอยู่ในบทที่ 5
//อ่านข้อมูลจากตาราง โดยเลือกเอา 30 แถวแรก(เรียงจากวันเวลาล่าสุด)
$sql = "SELECT * FROM guestbook
			ORDER BY date_posted DESC
			LIMIT 30";

$rs = mysqli_query($link, $sql);
if(mysqli_num_rows($rs) == 0) {
	echo "<h3>ยังไม่มีข้อความ</h3>";
}
else {
	echo '<div id="msg-container">';
	$first = true;
	while($gb = mysqli_fetch_array($rs)) {
		//ถ้าไม่ใช่ข้อความแรก ให้แสดงเส้นคั่นไว้ด้านบน
		if(!$first) {
			echo "<hr>";
		}
		echo "<span class=\"name\">
		 			<b>{$gb['name']}</b>";
					
		if(!empty($gb['email'])) {
					echo "[{$gb['email']}]";
		}
		echo "</span>";
				
		$ago = datetime_ago($gb['date_posted']);
		echo "<span class=\"ago\">$ago</span>
		 		<br class=\"clear\">";
				
		echo "<span class=\"msg\">{$gb['message']}</span>";
		$first = false;
	}
	echo '</div>';
}
mysqli_close($link);
?>
</body>
</html>