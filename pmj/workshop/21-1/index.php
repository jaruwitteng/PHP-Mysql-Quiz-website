<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 21-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		min-width: 300px;
	}
	div#indicator {
		display:none;
		position: fixed;
		right: 10px;
		bottom: 10px;
	}
	div.msg {
		width: 200px;
		border: solid 1px gray;
		background: #df9;
		padding: 5px;
		margin: 5px;
	}
	button#more-data {
		display: none;
		width: 210px;
		padding: 5px;
		margin: 5px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
var start_row = 0;		//ลำดับแถวเริ่มต้นในการอ่านข้อมูล
var row_count_first = 10;  //จำนวนแถว ครั้งแรกให้เลือกมา 10 แถว
var row_count_next = 5;  //ครั้งต่อๆไปเลือกมาครั้งละ 5 แถว
var first = true;			//เป็นการโหลดครั้งแรก(เมื่อเปิดเพจหรือไม่)
var loading = false;   //ใช้ตรวจสอบว่ากำลังโหลดอยู่หรือไม่ (ป้องกันปัญหาใน IE)

$(function() {
	$(window).scroll(function(event) {
		var diff = $(document).height() - $(this).height();
		if($(this).scrollTop() == diff) {  //ถ้า scrollTop เท่ากับผลต่างแสดงว่าสกรอลล์บาร์อยู่ล่างสุด
			if(!loading) {							//ป้องกันการโหลดซ้ำซ้อนใน IE
				scrollUpdate(start_row, row_count_next);
			}
		}
	});
	
	//เมื่อคลิกปุ่มแสดงเพิ่มเติม ให้โหลดข้อมูลมาแสดงด้วยหลักการเดียวกับการเลื่อนสกรอลล์บาร์
	$('button#more-data').click(function() {
		scrollUpdate(start_row, row_count_next);
	});
	
	 //เมื่อเปิดเพจ ให้โหลดข้อมูลมาแสดงด้วยหลักการเดียวกับการเลื่อนสกรอลล์บาร์
	scrollUpdate(start_row,  row_count_first); 
});

function scrollUpdate(start, row_count) {
	$.ajax({
		url:'load-data.php',
		type:'post',
		dataType:'html',
		data:{'start_row':start, 'row_count':row_count},
		beforeSend: function() {
			$('#indicator').css('display', 'block');   //แสดงภาพ indicator (ปกติถูกซ่อนไว้ด้วย CSS)
			loading = true;								   //แสดงสถานะว่ากำลังโหลด
		},
		success:function(result) {
			if(result.length != 0) {
				$('#container').append(result);
				
				//ถ้าเป็นการอ่านข้อมูลครั้งแรก
				if(first) {
					//หลังจากโหลดข้อมูลมาครั้งแรกแล้ว ให้แสดงปุ่ม(ปกติจะถูกซ่อนด้วย CSS)
					$('button#more-data').css('display', 'block');
					
					//กำหนดแถวเริ่มต้นในการอ่านข้อมูลครั้งต่อไปเท่ากับจำนวนแถวที่อ่านข้อมูลครั้งแรก
					start_row =  row_count_first;
					first = false;
				}
				 //การอ่านข้อมูลครั้งต่อไป ให้ลำดับแถวเริ่มต้นเพิ่มขึ้นเท่ากับจำนวนแถวที่อ่านในแต่ละครั้ง
				else { 
					start_row +=  row_count_next;
				}
			}
			 //ถ้าไม่มีข้อมูลส่งกลับมา เช่น อาจสิ้นสุดข้อมูลแล้ว หรือเกินจำนวนที่แสดงต่อหน้าแล้ว
			else {  
				$('button#more-data').css('display', 'none');   //ซ่อนปุ่มแสดงเพิ่มเติม
			}
		},
		complete:function() {
			$('#indicator').css('display', 'none');   //ซ่อน indicator
			loading = false;
		}		
	});
}
</script>
</head>
<body>
	<div id="container"></div>
    <button id="more-data">แสดงเพิ่มเติม</button>
    <br><br><br><br><br>
	<div id="indicator"><img src="load.gif"></div>
</body>
</html>