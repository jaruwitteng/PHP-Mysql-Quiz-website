<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 20-2</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	form {
		margin: auto;
		display: inline-block;
		width: auto;
		border: solid 1px gray;
		padding: 10px 0px;
		background: powderblue;
		margin: 10px 5px;
		min-width: 500px;
	}
	input[type="text"] {   
		width: 150px;
		margin-top: 3px;
	}
	[disabled] {
		background: lightgray;
		border: solid 1px gray;
	}
</style>
<script src="jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	//ข้อมูลแบบ JSON ซึ่งเป็นจำนวนไบต์ของแต่ละหน่วย
	var units = {'Bytes':1, 'KB':1024, 'MB':1048576, 'GB':1073741824};
	
	//เติมรายการของ select โดยจากค่าพร็อปเพอร์ตี้ของแต่ละหน่วย
	for(var $u in units) {
		$('select').append('<option value="' + units[$u] + '">' + $u + '</option>');
	}

	//เมื่อพิมพ์ข้อมูลลงในช่องขนาดไฟล์ ให้ทำการคำนวนทันที
	$('#filesize').keyup(function(event) {
		//อ่านขนาดของไฟล์ที่ใส่เข้ามา
		var size = $('#filesize').val();
		
		if(isNaN(size)) {
			alert('ขนาดของไฟล์ต้องเป็นตัวเลข');
			$(':text').val('');
		}		
		else if(size != '') {
			//ตรวจสอบหน่วยเริ่มต้นว่าหน่วยนั้นเท่ากับกีไบต์
			//เช่น ถ้าเลือก KB จะได้ค่าเป็น 1024
			var u1 = $('#unit1').val();
			var bytes = size * u1;   //เปลี่ยนเป็นจำนวนไบต์

			//ตรวจสอบหน่วยเป้าหมายว่าหน่วยนั้นเท่ากับกี่ไบต์
			//เช่น ถ้าเลือก MB จะได้ค่าเป็น 1048576
			var u2 = $('#unit2').val();
			var result = bytes / u2;  //แปลงค่าเป็นหน่วยเป้าหมายที่ต้องการ
			
			$('#result').val(result);  //แสดงผลลัพธ์
		}
		else {
			$(':text').val('');
		}
	});
	
	//เมื่อเปลี่ยนหน่วยไม่ว่าที่ช่องใด ก็ให้ตอบสนองเช่นเดียวกับการพิมพ์ข้อมูลลงในช่องขนาดไฟล์
	$('select').change(function() {
		$('#filesize').keyup();
	});
});
</script>
</head>

<body>
<form>
	<input type="text" id="filesize" placeholder="ขนาดของไฟล์">
    <select id="unit1"></select>
	<span> = </span>
	<input type="text" id="result" disabled>
    <select id="unit2"></select>    
</form>
</body>
</html>