<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
<style>
	body {
		margin: 0px;
		background: url(images/bg.jpg) fixed;
	}
	body > * {
		font-family: tahoma;
	}
	#fixed-container {
		position: fixed;
		width: 100%;
		height: 80px;
		z-index: 1000;
	}
	table {
		margin: auto;
		border-collapse: collapse;
		min-width: 1000px;
	}
	#table-top {
		margin: auto;
		background: powderblue;
	}
	#table-top td {
		border-bottom: solid 1px gray;
	}
	#table-bottom {
		position: relative;
		top: 60px;
		margin-bottom: 30px;
	}
	#table-bottom td {
		padding-top: 2px;
	}
	td {
		vertical-align: top;
	}
	#table-top tr {
		border-left: solid 1px powderblue;
		border-right: solid 1px powderblue;
	}
	#td-logo, #td-aside-left, #td-cart, #td-aside-right {
		width: 150px;
	}
	#td-logo {
		background: url(images/logo.gif) center center no-repeat;
		border-left: solid 1px gray;
	}
	#td-toolbar, #td-content {
		width: 650px;
	}
	#td-cart {
		text-align: center;
		vertical-align: top;
		font-size: 16px;
		color: brown;
		padding-top: 5px;
		border-bottom: solid 1px gray;
		border-right: solid 1px gray;
	}
	#td-aside-left {
		background: #555;
		border-left: solid 1px gray;
	}
	#td-content { 
		text-align: center;
		background: white;
	}
	#td-aside-right {
		background: lavender;
		border-right: solid 1px gray;
	}
	#td-footer {
		border-top: solid 1px gray;
		padding: 5px;
		text-align: center;
		color: navy;
		font-size: 12px;
	}
	a {
		color: blue;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
	.section-pro {
		float: left;
		width: 310px;
		height: 110px;
		margin: 1px 3px;
	}
	.div-img {
		float: left;
		width: 100px;
	}
	.div-summary {
		float: left;
		width: 200px;
		text-align: left;
		font-size: 14px;
	}
	a.pro-name, span.pro-name {
		font-size: 16px;
		font-weight: bold;
		text-decoration: none;
	}
	.div-summary span.price {
		display: inline-block;
		margin: 5px 10px 0px 0px;
		color: green;
	}
	.div-summary a.more-detail {
		float: right;
		margin-right: 3px;
		text-decoration: none;
		margin-top: 5px;
		color: brown;
	}
	.div-summary a.more-detail:hover {
		color:red;
	}
	#td-toolbar a {
		display: inline-block;
		text-align: center;
		padding: 5px 10px 2px 5px;
		text-decoration: none;
		border: solid 1px inherit;
	}
	#td-toolbar a:hover {
		background: #ffc;
	}
	#td-toolbar a img {
		height: 32px;
		width: 32px;
		border: none;
	}
	#img-cart {
		float: left;
		height: 48px;
		vertical-align: top;
		margin: 5px 0px 0px 5px;
	}
	button#order {
		margin-top: 3px;
		padding: 3px 10px;
		background: salmon;
		font-size: 16px;
		border-radius: 5px;
		border: solid 1px gold;
		color: cyan;
		width: auto;
		cursor: pointer;
	}
	button#order:hover {
		background: #ffc;
		color: red;
	}
	form {
		float: right;
		padding-right: 10px;
		margin-bottom: 5px;
	}
	br.clear {
		clear: both;
	}
	.div-img img {
		max-width: 60px;
		max-height: 60px;
	}
	div#pagenum {
		width: 90%;
		text-align: center;
		margin-bottom: 20px;
	}
	div#dialog {
		display: none;
	}
	.ui-dialog {
		z-index: 5000 !important;
	}
	.ui-widget-overlay {
		z-index: 4000 !important;
	}
	#dialog-content {
		width: 500px;
		text-align: left;
		font-size: 14px;
	}
	#dialog-content img {
		max-width: 60px;
		max-height: 60px;
		margin: 10px 10px;	
		border: solid 1px white;	
	}
	#dialog-content img:hover {
		border: solid 1px blue;
	}
	#dialog span {
		display: block;
		margin-bottom: 15px;
	}
	#dialog-pro-name {
		font-size: 16px;
		font-weight: bold;
		color: green;
		display: block;
		margin-top: 10px;
	}
	#dialog-pro-detail {

	}
	#dialog-cat, #dialog-add-cart {
		float: right;
		margin-right: 1px;
	}
	#dialog-quantity {
		width: 50px;
	}
	#dialog-add-cart {
		
	}
	#dialog-form {
		border: solid 1px gray;
		background: powderblue;
		margin-bottom: 5px;
		display: block;
		width: 98%;
		padding: 5px;
	}
	span#cat-name {
		display: block;
		padding: 10px 3px 5px 10px;
		color: yellow;
		font-size: 18px;
		font-weight: bold;
		width: auto;
		border-bottom: dotted 1px silver;
	}
	span#cat-name > img {
		width: 20px;
		vertical-align: middle;
		margin-right: 3px;
	}
	a.category {
		display: block;
		border-bottom: dotted 1px silver;
		color: aqua;
	}
	a.category:hover {
		background: #ffc;
		color: red;
	}
	a.category > li {
		padding: 5px 2px 5px 15px;
	}
	a.category li {
		list-style-position: inside;
	}
	span#pop {
		display: block;
		padding: 10px 3px 5px 10px;
		color: green;
		font-size: 16px;
		font-weight: bold;
		width: auto;
	}
	span#pop > img {
		width: 18px;
		vertical-align: middle;
		margin-right: 1px;
	}
	.div-bestseller {
		width: 96%;
		border-top: dotted 1px gray;
		margin: 0px auto;
		padding: 3px 0xp;
	}
	.div-bestseller:last-child {
		border-bottom: dotted 1px gray;
	}
	.img-bestseller {
		width: 24px;
		height: 24px;
		vertical-align: top;
		margin: 5px;
		float: left;
		border-radius: 5px;
	}
	.pro-name-bestseller {
		font-size: 14px;
	}
	#out-of-stock {
		color:red;
		text-align:center;
		display: block;
	}
</style>	
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	
	$('a.more-detail, a.pro-name, a.pro-name-bestseller').click(function() {
		var id = $(this).attr('data-id');
		$.ajax({
			type: 'post',
			url: 'product-load.php',
			data: {'id': id},
			dataType: 'html',
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังโหลดข้อมูล...</h3>'});
			},
			success: function(result) {
				$.unblockUI();
				$('#dialog').html(result);
				$('#dialog').dialog({
					title: 'รายละเอียดสินค้า',
					modal: true,
					width: 'auto',
					position: { my: "center top", at: "center top+70px", of: window}
				});
				$('.ui-dialog-titlebar-close').focus();
			},
			complete: function() {
				$.unblockUI();
			}
		});
	});
	
	//ใช้ on() เพราะปุ่มในไดอะล็อกถูกโหลดมาทีหลังเพจ
	$(document).on('click', 'button#dialog-add-cart', function() {
		if(!$.isNumeric($('#dialog-quantity').val())) {
			alert('กรุณาใส่จำนวนสินค้าเป็นตัวเลข');
			return false;
		}
		var err = false;
		$('#dialog select').each(function(index, value) {
			if($(this).children('option:selected').index()==0) {  //ถ้าไม่ได้เลือกคุณลักษณะ
				alert('กรุณาเลือก: ' + $(this).val());
				err = true;
				return false;
			} 
		});
		
		if(err) {
			return;
		}
		
		$.ajax({
			type: 'post',
			url: 'cart-add.php',
			data: $('#dialog-form').serializeArray(),
			dataType: 'html',
			beforeSend: function() {
				$('#dialog').block({message:'<h3>กำลังหยิบใส่รถเข็น...</h3>'});
			},
			success: function(result) {
				if(result.length > 0) {
					$('#dialog').unblock();
					alert(result);
				}
				else {
				cartCount();
				$('#dialog').block({message:'<h3>เพิ่มสินค้าในรถเข็นแล้ว...</h3>', timeout:2000, showOverlay:false, 
				 							css: {padding:'2px 20px', background:'#ffc', color:'green', width: 'auto'}});
				}
			}
		});
	});
	
	$('button#order').click(function() {  //เมื่อคลิกปุ่มสั่งซื้อที่อยู่ตรงรถเข็น
		location.href = "order-cart.php";	
	});
	
	cartCount(); //ให้อ่านข้อมูลในรถเข็นมาแสดงทันทีที่เปิดเพจ (อาจเปิดไปเพจอื่นแล้วกลับมาที่หน้าหลักอีก)
	
});

function cartCount() {  //ฟังก์ชั่นสำหรับอ่านข้อมูลในรถเข็น
	$.ajax({
		type: 'post',
		url: 'cart-count.php',
		dataType: 'html',
		success: function(result) {	
			$('#cart-count').html(result);
		}
	});
}
</script>
</head>

<body>
<div id="fixed-container">
<table id="table-top">
<tr>
<td id="td-logo">&nbsp;</td>
<td id="td-toolbar">
<a href="index.php">
	<img src="images/global.png"><br>
    หน้าแรก
</a>
<a href="how-to-order.php">
	<img src="images/cart.png"><br>
    วิธีการสั่งซื้อ
</a>
<a href="how-to-pay.php">
	<img src="images/creditcard.png"><br>
   การชำระเงิน
</a>
<a href="order-paid.php">
	<img src="images/megaphone.png"><br>
    แจ้งการโอนเงิน
</a>
<a href="order-history.php">
	<img src="images/clock.png"><br>
    ประวัติการสั่งซื้อ
</a>
<a href="contact-us.php">
	<img src="images/phone.png"><br>
   ติดต่อเรา
</a>
</td>
<td id="td-cart">
<img src="images/cart.gif" id="img-cart">
รถเข็น (<span id="cart-count">0</span>) 
<button id="order">สั่งซื้อ &raquo;</button>
</td>
</tr>
</table>
</div>

<table id="table-bottom">
<tr>
<td id="td-aside-left">
<span id="cat-name"><img src="images/folder.png"> หมวดหมู่</span>
<?php 
include "dblink.php";
include "lib/pagination.php";
$sql = "SELECT * FROM categories LIMIT 20";
$r = mysqli_query($link, $sql);
$self = $_SERVER['PHP_SELF'];
$h = $self . "?catid=";
echo "<a href=\"$h\" class=\"category\"><li>ทั้งหมด</li></a>";
while($cat = mysqli_fetch_array($r)) {
	$h = $self . "?catid=" . $cat['cat_id'] . "&catname=" . $cat['cat_name'];
	echo "<a href=\"$h\" class=\"category\"><li>". $cat['cat_name'] . "</li></a>";
}
?>
</td>
<td id="td-content"><br>
<?php
$field = "ทั้งหมด";
$sql = "SELECT *  FROM products ";
if(isset($_GET['catid']) && !empty($_GET['catid'])) {
	$cat_id  = $_GET['catid'];
	$sql .= "WHERE cat_id  = '$cat_id' ";
	$field = $_GET['catname'];
}
$sql .= "ORDER BY pro_id DESC";
$result = page_query($link, $sql, 10);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
 	echo "รายการสินค้า: $field  (ลำดับที่  $first - $last จาก $total)"; 
?>
    <form>
    <input type="text" name="kw" placeholder="ค้นหา">
    <button>OK</button>
    </form><br class="clear"><br>
<?php
include "lib/IMGallery/imgallery-no-jquery.php";

while($pro = mysqli_fetch_array($result)) {
	 $id =  $pro['pro_id'];
	 $src = "read-image.php?pro_id=" . $pro['pro_id'];
 ?>
<section class="section-pro">
	<div class="div-img"><?php gallery_echo_img($src); ?></div>
    <div class="div-summary">
    <?php
		echo "<a href=# class=\"pro-name\" data-id=\"$id\">". $pro['pro_name'] . "</a><br>";
    	echo mb_substr($pro['detail'], 0, 50, 'utf-8') . "...<br>";
		
		echo "<a href=# class=\"more-detail\" data-id=\"$id\">รายละเอียด &raquo;</a>";
		echo  "<span class=\"price\">ราคา: " . number_format($pro['price']) . "</span>"; 
	?>
    </div>
</section> 
<?php
}
?>
<br class="clear">
<?php
	if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
		echo '<div id="pagenum">';
		page_echo_pagenums();
		echo '</div>';
	}
?>
</td>
<td id="td-aside-right">
    <span id="pop"><img src="images/star.png"> สินค้าขายดี</span>
    <?php 
		$sql = "SELECT order_details.pro_id, SUM(order_details.quantity) AS quan, products.pro_name 
		 			FROM order_details LEFT JOIN products ON order_details.pro_id = products.pro_id
 					GROUP BY order_details.pro_id ORDER BY quan DESC LIMIT 5";
		$r = mysqli_query($link, $sql);
		while($pro = mysqli_fetch_array($r)) {
			$pro_id = $pro['pro_id'];
			$pro_name = $pro['pro_name'];
			$src = "read-image.php?pro_id=$pro_id";
			echo '<div class="div-bestseller">';
			echo "<img src=\"$src\" class=\"img-bestseller\">";
			echo "<a href=# class=\"pro-name-bestseller\" data-id=\"$pro_id\">$pro_name</a><br class=\"clear\">";
			echo '</div>';
		}
	?>
</td>
</tr>
<tr>
<td colspan="3" id="td-footer">&copy; <?php echo date('Y'); ?> All Rights Reserved - <a href="../DataStore/">Administrator</a></td>
</tr>
</table>
<div id="dialog"></div>
</body>
</html>
<?php mysqli_close($link);  ?>