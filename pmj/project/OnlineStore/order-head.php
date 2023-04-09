<?php 
	$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);
	$ca = ($page=="order-cart.php")?"current":"";
	$cu = ($page=="order-cust.php")?"current":"";
	$do = ($page=="order-done.php")?"current":"";
?>

<span id="cart" class="<?php echo $ca; ?>"><img src="images/cart.png">รายสินค้าในรถเข็น</span>
<span class="raquo">&raquo;</span>
<span id="cust" class="<?php echo $cu; ?>"><img src="images/contacts.png">ข้อมูลลูกค้า</span>
<span class="raquo">&raquo;</span>
<span id="done" class="<?php echo $do; ?>"><img src="images/flag.png">เสร็จสิ้นการสั่งซื้อ</span>