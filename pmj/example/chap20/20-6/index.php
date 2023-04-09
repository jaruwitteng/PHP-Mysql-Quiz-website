<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-6</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	input[type="text"] { 
	 	display: block;  
		width: 300px;
		margin-top: 3px;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	var input = '<input type="text" name="choice[]">';
	
	//เมื่อคลิกปุ่ม + ให้เพิ่มอิลิเมนต์ text ลงไปในฟอร์ม
	$('#add').click(function() {
		$('form').append(input);
	});
	
	//เมื่อคลิกปุ่ม - ให้ลบอิลิเมนต์ text ที่ชื่อขึ้นต้นด้วยคำว่า "choice" ตัวสุดท้าย ออกจากฟอร์ม
	$('#remove').click(function() {
 		$('input[name^=choice]:last').remove();
	});
});
</script>
</head>

<body>
<form>
 	หัวข้อโพล: <input type="text" name="topic"><br>
 	ตัวเลือก: 
 	<button type="button" id="add">+</button>
 	<button type="button" id="remove">-</button>
 </form>
</body>
</html>
