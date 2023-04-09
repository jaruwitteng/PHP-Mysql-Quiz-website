<?php 
session_start();
if(!isset($_SESSION['admin'])) {
	header("location:login.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Poll & Vote</title>
<style>
	@import "global.css";
	form {
		width: 400px;
		text-align: left;
		margin: 30px auto;
		background: #bcb;
	}
	div#top,  div#bottom {
		background: #dd9;
		padding: 3px 0px;
	}
	div#top {
		border-bottom: solid 1px #999;
		font-size: 16px;
		color: green;
		margin-bottom: 20px;
		padding: 5px;
	}
	div#center {
		margin-left: 20px;
	}
	div#bottom {
		display: inline-block;
		border-top: solid 1px #999;
		margin-top: 20px;
		width: 100%;
		padding: 5px 0px;
	}
	input[type=text] {
		background: #ffc;
		border: solid 1px gray;
		padding:2px
	}
	input[name=topic] {
		width: 300px;
	}
	input[name^=choice] { 
		width: 200px;
		margin: 1px 5px 1px 0px;
	}
	div.choice {
		margin: 3px;
	}
	button[type=submit] {
		margin: 10px 10px 0px 0px;
	}

	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 1px 10px;
	}
	button#submit {
		margin-left: 10px;
	}
	br.clear {
		clear: right;
	}
	button:hover {
		color: aqua;
	}
	h3.err {
		text-align: center;
		color: red;
	}
	div#bottom a {
		float: right;
		margin: 3px 10px 0px 0px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	var input = '<div class="choice">';
	input += '<input type="text" name="choice[]" placeholder="ตัวเลือก" required>';
	input += '<input type="color" name="color[]"> (สีของกราฟ)</div>';
	
	//เมื่อคลิกปุ่ม + ให้เพิ่มอิลิเมนต์ div(ซึ่งบรรจุ text) ลงไปในฟอร์ม
	$('#add').click(function() {
		if($('div.choice').length == 10) {  //ต้องมีไม่เกิน 10 อัน(ตัวเลือก)
			return false;
		}
		$('#choice-container').append(input);
	});
	
	//เมื่อคลิกปุ่ม - ให้ลบอิลิเมนต์ div(ซึ่งบรรจุ text) ตัวสุดท้าย  ออกจากฟอร์ม
	$('#remove').click(function() {
		if($('div.choice').length == 2) {   //ต้องมีอย่างน้อย 2 อัน
			return false;
		}
 		$('input[name^=choice]:last').parent().remove();
	});
	$('#add').click();
	$('#add').click();
});
</script>
</head>

<body>
<table id="container">
<tr><td colspan="3" id="header"><h1>DeveloperThai.com</h1></td></tr>
<tr>
<td id="left-side">&nbsp;</td>
<td id="content">
<?php
if($_POST) {
	include "dblink.php";
	
	//เพิ่มหัวข้อโพลลงในตาราง poll_topic
	$topic = $_POST['topic'];
	$sql = "INSERT INTO poll_topic VALUES('', '$topic', 'inactive')";
	mysqli_query($link, $sql);
	$topic_id = mysqli_insert_id($link);
	
	//ต่อไปเพิ่มตัวเลือกลงในตาราง poll_choice โดยนำแต่ละตัวเลือกมา
	//สร้างเป็น SQL ในรูปแบบ INSERT INTO ... VALUES(...), (...), (...)
	$choices = array();
	for($i = 0; $i < count($_POST['choice']); $i++) {
		$ch_text = $_POST['choice'][$i];
		$color = $_POST['color'][$i];
		//กำหนดสตริงในแบบ ('', '...', '...', ...)
		$str = "('', '$topic_id', '$ch_text', '0', '$color')";
		array_push($choices, $str);
	}
	//นำแต่ละตัวเลือกมาต่อกันในแบบ ('', '...', ...), (...), (...)
	$value = implode(",", $choices);
	
	$sql = "INSERT INTO poll_choice VALUES$value";
	mysqli_query($link, $sql);
	
	echo "<h3>จัดเก็บข้อมูลแล้ว</h3>";
	
	mysqli_close($link);
}
?>
	<form method="post">
	<div id="top">เพิ่มหัวข้อโพล</div>
    <div id="center">
 		<input type="text" name="topic" placeholder="หัวข้อโพล" required><br><br>
 		ตัวเลือก: 
 		<button type="button" id="add">+</button>
 		<button type="button" id="remove">-</button> (2-10)
    	<div id="choice-container"></div>
    </div>
	<div id="bottom">
    	<button id="submit">ตกลง</button>
 		<a href="manage-poll.php">จัดการโพล</a> 
        <a> - </a>
 		<a href="index.php">หน้าหลัก</a>
		<br class="clear">
	</div>
	</form>  
</td>
<td id="right-side">&nbsp;</td>
</tr>
</table>
</body>
</html>