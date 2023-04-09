<?php 
include "check-login.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Store</title>
<style>
	body {
		font: 14px tahoma;
		text-align: center;
	}
	input:not([type=file]), select, textarea {
		font: 14px tahoma;
		background: lavender;
		border: solid 1px gray;
		padding: 1px;
		margin: 3px;
	}
	button {
		font: 14px tahoma;
	}
	[name=pro_name], [name=detail] {
		width: 400px;
	}
	[name=detail] {
		height: 100px;
		overflow: auto;
		resize: none;
	}
	[name=price], [name=quantity] {
		width: 100px;
	}
	[name=category] {
		width: 104px;
	}
	[name=supplier] {
		width: 240px;
	}
	.attr-name {
		width: 80px;
	}
	.attr-value {
		width: 308px;
	}
	#form-pro {
		display: inline-block;
		width: 530px;
		background: #dfd;
		padding: 5px;
		text-align: left;
	}
	#form-pro button {
		display: block;
		margin: auto;
	}
	.form-upload {
		display: inline-block;
		width: 530px;
		border-bottom: solid 1px gray;
		background: #ef9;
		padding: 5px;
		text-align: left;
	}
	.form-upload:nth-of-type(6) {
		border-bottom: none !important;
	}
	.div-no-img {
		display: inline-block;
		width: 50px;
		height: 30px;
		border: solid 1px gray;
		margin: 5px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.form.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#bt-send').click(function() {
		var d = $('#form-pro').serializeArray();
		$.ajax({
			url: 'product-edit-save.php',
			data: d,
			type: 'post',
			dataType: "html",
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				location.reload();
				opener.location.reload();
			},
			complete: function() {
				$.unblockUI();
			}
		});
	});
	
	$('.delete-img').click(function(event) {
		if(!confirm('ยืนยันการลบภาพนี้')) {
			return;
		}
		var id = $(this).attr('data-id');
		var d = {img_id: id};
		$.ajax({
			url: 'product-edit-delete-img.php',
			data: d,
			type: 'post',
			dataType: "html",
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				location.reload();
				opener.location.reload();
			},
			complete: function() {
				$.unblockUI();
			}
		});		
	});

	$('.bt-upload').click(function() {
		$(this).parent('form').ajaxForm({
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังอัปโหลดภาพ</h3>'});
			}, 
			complete: function() { 
				$.unblockUI();
				location.reload();
				opener.location.reload();
			}
		});		
	});	
	
});
</script>
</head>

<body>
<?php
include "dblink.php";
$pro_id = $_GET['id'];
$sql = "SELECT products.*, categories.cat_name,  suppliers.sup_name 
 			FROM products 
			LEFT JOIN categories 
			ON products.cat_id = categories.cat_id	
			LEFT JOIN suppliers 
			ON products.sup_id = suppliers.sup_id
			WHERE products.pro_id = $pro_id";
	
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
?>
<h3>แก้ไขข้อมูลสินค้า</h3>
<form id="form-pro">
<input type="hidden" name="pro_id" id="pro-id" value="<?php echo $row['pro_id']; ?>">
<input type="text" name="pro_name" id="pro-name" value="<?php echo $row['pro_name']; ?>"> (ชื่อสินค้า) <br>
<textarea name="detail" id="detail"><?php echo $row['detail']; ?></textarea> (รายละเอียด)<br>
<input type="text" name="price" id="price" value="<?php echo $row['price']; ?>"> (ราคา)&nbsp;&nbsp;
<input type="text" name="quantity" id="quantity"value="<?php echo $row['quantity']; ?>"> (จำนวนสินค้า)<br>
<select name="category" id="category">
    <?php 
	$sql = "SELECT * FROM categories";
	$r_cat= mysqli_query($link, $sql);

	while($cat = mysqli_fetch_array($r_cat)) {
		echo "<option value=\"{$cat['cat_id']}\">{$cat['cat_name']}</option>";
	}
	?>
</select> (หมวด)&nbsp;
<script> $('#category').val('<?php echo $row['cat_id']; ?>'); </script>
<select name="supplier" id="supplier">
    <?php 
	$sql = "SELECT sup_id, sup_name FROM suppliers";
	$r_sup = mysqli_query($link, $sql);
	while($sup = mysqli_fetch_array($r_sup)) {
		echo "<option value=\"{$sup['sup_id']}\">{$sup['sup_name']}</option>";
	}
	?>
</select> (ผู้จัดส่ง)
<script> $('#supplier').val('<?php echo $row['sup_id']; ?>'); </script>
<br><br>
<?php
	$sql = "SELECT * FROM attributes WHERE pro_id = $pro_id ORDER BY attr_id ASC";
	$r = mysqli_query($link, $sql);
?>

<?php  $attr = mysqli_fetch_array($r); ?>
<input type="hidden" name="attr_id[]" value="<?php echo $attr['attr_id']; ?>">
<input type="text" name="attr_name[]" class="attr-name" value="<?php echo $attr['attr_name']; ?>">  
<input type="text" name="attr_value[]"  class="attr-value" value="<?php echo $attr['attr_value']; ?>"> (คุณลักษณะ/ค่า)<br>

<?php  $attr = mysqli_fetch_array($r); ?>
<input type="hidden" name="attr_id[]" value="<?php echo $attr['attr_id']; ?>">
<input type="text" name="attr_name[]" class="attr-name" value="<?php echo $attr['attr_name']; ?>">
<input type="text" name="attr_value[]" class="attr-value"  value="<?php echo $attr['attr_value']; ?>"> (คุณลักษณะ/ค่า)<br>

<?php  $attr = mysqli_fetch_array($r); ?>
<input type="hidden" name="attr_id[]" value="<?php echo $attr['attr_id']; ?>">
<input type="text" name="attr_name[]" class="attr-name" value="<?php echo $attr['attr_name']; ?>">
<input type="text" name="attr_value[]" class="attr-value"  value="<?php echo $attr['attr_value']; ?>"> (คุณลักษณะ/ค่า)<br><br>
<button type="button" id="bt-send">ส่งข้อมูล</button>
</form>
<br><br>
<?php
include "lib/IMGallery/imgallery-no-jquery.php";
$row = $first;
$sql = "SELECT * FROM images WHERE pro_id = $pro_id ORDER BY img_id ASC";
$r = mysqli_query($link, $sql);
	
$src = "read-image.php?id=";
gallery_thumb_width(50);

for($i = 1; $i <= 5; $i++) {		
?> 	
  <form class="form-upload" method="post" action="product-edit-image.php" enctype="multipart/form-data">
<?php 
	$img =mysqli_fetch_array($r);
	$img_id = $img['img_id'];
	if($img) {
		gallery_echo_img($src . $img_id); 
	}
	else {
		echo "<div class=\"div-no-img\"></div>";
	}
?> 
    <input type="hidden" name="img_id" value="<?php echo $img_id; ?>">
 	<input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
 	<input type="file" name="file">
 	<button type="submit" class="bt-upload">อัปโหลดภาพ</button>
<?php
		if($img) {
			 echo '<button type="button" class="delete-img" data-id="' . $img_id . '">ลบภาพนี้</button>';
		}
 ?>
	</form>
	<br>
<?php
}   //end for
?>
<br><br><br>
</body>
</html>