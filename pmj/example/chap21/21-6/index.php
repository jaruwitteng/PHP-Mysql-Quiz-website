<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 21-6</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		min-width: 500px;
	}
	div.product, #cart {
		width: 200px;
		border: solid 1px gray;
		background: powderblue;
		padding: 3px;
		margin: 5px;
	}
	#cart {
		float: right;
		margin: 0px;
	}
	#cart > h4 {
		text-align: center;
		margin: 0px;
	}
	#list {
		color: red;
	}
	div.product > h3 {
		margin: 2px;
	}
	div.product > [type=number] {
		width: 50px;
	}
	div.product > button {
		border: solid 1px gray;
		background:#fc9;
		border-radius: 3px;
	}
	div.product > button:not([disabled]):hover {
		background: yellow;
		color:red;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('div.product > button').click(function(event) {
			var id = $(event.target).attr('data-id');
			//อ่านจำนวนจากอิลิเมนต์ชนิด text ที่อยู่ก่อนปุ่มที่ถูกคลิก
			var q = $(this).prev('[type=number]').val();
			$.ajax({
				url: 'cart.php',
				data: {'id':id, 'q':q},
				type: 'post',
				dataType: 'json',
				success: callback
			});
	});
	
	$('div.product > [type=number]').keyup(function(event) {
			var q = $(this).val();
			if(isNaN(q) || q <= 0) {
				$(this).val('');
				$(this).next('button').attr('disabled', ' ');
			}
			else {
				$(this).next('button').removeAttr('disabled');
			}
	});
});

function callback(result) {
	var t = '<ul>';
	//ลักษณะข้อมูล json ที่ส่งกลับมาจะอยู่ในรูปแบบ รหัสสินค้า:จำนวนที่ซื้อ เช่น {p1:2, p4:1}
 	//ในการแสดงผลเราจะตัดเอาตัวเลขที่อยู่ถัดจากตัว "p" ซึ่งเป็นตำแหน่งที่ 1 เป็นต้นไปจนสิ้นสุดสตริง
	//จากนั้นนำไปต่อท้ายคำว่า "สินค้า" เพื่อให้รู้ว่าหยิบสินค้าชนิดใด แล้วตามด้วยจำนวนที่หยิบ
	for(var p in result) {
			var x = p.substring(1);  //ค่า id อยู่ในรูปแบบ px ตัดเอาเฉพาะตัวเลขต่อท้าย
			t += "<li>สินค้า " + x + " (" + result[p] + ')</li>';
	}
	t += '</ul>';
	$('#list').html(t);
}
</script>
</head>

<body>
<div id="cart">
	<h4>
		<img src="cart.gif" width="100"><br>
    	รายการสินค้าในรถเข็น
	</h4>
    <div id="list"></div>
</div>

<?php
for($i=1; $i<=5; $i++) {
	echo '
	<div class="product">
		<h3>สินค้าชนิดที่ #'.$i.'</h3>
		เลือก: <input type="number" value="1" min="1" max="10">
		<button data-id="p'.$i.'">หยิบใส่รถเข็น</button>
	</div>
	';
}
?>
</body>
</html>