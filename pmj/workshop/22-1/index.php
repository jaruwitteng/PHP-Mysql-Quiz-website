<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 22-1</title>
<style>
	* {
		font: 13px tahoma;
	}
	body {
		background: url(bg.jpg);
		min-width: 500px;
		margin: 0px;
	}
	header {
		background: steelblue;
		color: white;
		font-family: 16px;
		padding: 10px;
		position: fixed;
		width: 100%;
		height: 40px;
		z-index: 1000;
		border-bottom: solid 3px orange;
	}
	header h1 {
		margin: 2px;
		font-size: 20px;
		color: aqua;
	}
	div#content {
		min-width: 500px;
		margin-left: 20px;
		position: relative;
		top: 80px;
	}
	img.pic {
		width: 80px;
		float:left;
		margin-right: 5px;
		border-radius: 7px;
		z-index: 5000;
		cursor: move;
	}
	div.detail {
		width: 250px;
		float:left;
		font: 10pt tahoma;
	}
	div.detail > span {
		font: bolder 14px tahoma;
		color: #c00;
	}
	br.clear {
		clear: left;
	}
	table.tb-detail td:nth-child(1){
		width: 100px;
		background: powderblue;
		vertical-align: top;
		font-weight: bold;
		padding: 3px;
	}
	table.tb-detail td:nth-child(2){
		width: 350px;
		background: #dee;
		vertical-align: top;
		padding: 3px;
	}
	table.tb-detail img {
		border-radius: 7px;
	}
	#cart {
		width: 150px;
		border: solid 2px magenta;
		background: #beb;
		padding: 3px;
		position: fixed;
		top: 5px;
		right: 5px;
		z-index: 1000;
	}
	#cart h4 {
		text-align: center;
		margin: 0px;
		font-weight: bold;
	}
	#indicator {
		margin-top: 5px;
		display: none;
	}
	#img-cart {
		width: 60px;
	}
	#list {
		font-size: small;
		color: #c00;
	}
	#list ul {
		list-style-position: inside;
		padding: 0px 0px 0px 5px;
	}
	.ui-dialog {
		z-index: 10000 !important;
	}
	.ui-widget-overlay {
		z-index: 9000 !important;
	}
	a {
		color: blue;
	}
	a:hover {
		color:red;
	}
</style>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function(){
	$('div.detail > a').click(function(event){
		var id = $(this).attr('data-id');
		$.ajax({
			url: 'full-details.php',
			data: {'id': id},
			dataType:"text",
			cache: false,
			success: function(result){
				var div = $('<div class="dialog"></div>');
				div.html(result).dialog({title: 'ข้อมูลสินค้า', width: 500, modal:true});
				$('.ui-dialog-titlebar-close').focus();
			},
			beforeSend: function(){
				$.blockUI({message: '<h3>Loading...</h3>'});
			},
			complete: function(){
				$.unblockUI();
			}
		});
	});
	
	cartCheck();  //เมื่อเปิดเพจให้ตรวจสอบสินค้าในรถเข็น
	
	$('img.pic').draggable({helper: 'clone'});  //ทำให้ภาพสินค้าสามารรถเคลื่อนย้ายได้
	
	$('#cart').droppable({				//ทำให้กรอบแสดงรายการในรถเข็นสามารถดร็อปได้
		drop: function(event, ui){
			//อ่านค่า id ของภาพที่ลากมา โดยอ่านค่า id จากแอตทริบิวต์ data-id
			var id = $(ui.draggable).attr('data-id');
				
			$.ajax({
				url: 'cart-add.php',
				type: "post",
				data: {'id': id},
				dataType: 'html',
				success: function(result){
					cartCheck();    //หลังการ drop ให้ตรวจสอบสินค้าในรถเข็น
				},
				beforeSend: function(){
					$('#cart').block({message:$('#indicator')});
				}
			});
		}
	});
	
	//เมื่อคลิกลิงก์ [x] เพื่อลบ ซึ่ง <a> วางซ้อนอยู่ใน <li>
	//ใช้ on() เพราะลิงก์ถูกสร้างขึ้นมาภายหลังการโหลดเพจ
	$(document).on('click', 'li > a', function() {
		var id = $(this).attr('data-id');
			$.ajax({
				url: 'cart-delete.php',
				type: "post",
				data: {'id': id},
				dataType: 'html',
				success: function(result){
					cartCheck();
				},
				beforeSend: function(){
					$('#cart').block({message:$('#indicator')});
				}
			});		
	});
	
});

function cartCheck() {
	$.ajax({
		url: 'cart-check.php',
		dataType: 'json',
		success: function(result){
			//อ่านผลลัพธ์ซึ่งถูกส่งกลับมาในแบบ JSON 
			var t = '<ul>';
			for(var p in result){
				//สร้างลิงก์ [x] ไว้หน้ารายการสำหรับการลบ
				a = '[<a href=# data-id="' + p + '">x</a>]';
				t += "<li>" + a + ' ' + result[p] + '</li>';
			}
			t += '</ul>';
			$('#list').html(t);
		},
		beforeSend: function(){
			$('#cart').block({message:$('#indicator'), ignoreIfBlocked: true});
		},
		complete: function(){
			$('#cart').unblock();
		}
	});
}
</script>
</head>

<body>
<header>
	<h1>AJAX Drag & Drop Shopping Cart</h1>
	ถ้าต้องการซื้อสินค้าใด ให้ลากภาพสินค้านั้นไปใส่ในรถเข็น
</header>
<div id="content">
<?php
 include "dblink.php";
$sql = "SELECT * FROM shopping_cart";
$rs = mysqli_query($link, $sql);
while($data = mysqli_fetch_array($rs)) {	
	//ลักษณะการเก็บชื่อภาพในตาราง เช่น "img1.png, img2.png, img3.png"
 	//เราจึงแยกชื่อไฟลฺ์ภาพออกจากกันด้วย "," ซึ่งการใช้แพตเทิร์นเผื่อจะมีช่องว่างอยู่ก่อนและหลัง ","
	$img = preg_split("/[ ]*,[ ]*/", $data['image']);
	
	//นำภาพแรกของสินค้านั้นมาแสดง
	$img1 = $img[0];
	echo '<img src="pics/'.$img1.'" class="pic" data-id="'.$data['item_id'].'">';
	echo '<div class="detail">';
	echo '<span>'.$data['name'].'</span><br>';
	echo mb_substr($data['detail'], 0, 80, 'utf-8').'...<br>';
	echo '<a href=# data-id="'.$data['item_id'].'">รายละเอียดทั้งหมด</a>';
	echo '</div><br class="clear"><br>';
}
mysqli_close($link);
?>
</div>

<div id="cart">
	<h4><img src="pics/cart.gif" id="img-cart"><br>รายการสินค้าในรถเข็น</h4>
    <div id="list"></div>
</div>
<img  src="pics/load.gif" id="indicator" >

</body>
</html>