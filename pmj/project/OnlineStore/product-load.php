<?php
sleep(1);

include "dblink.php";
$pro_id = $_POST['id'];
$sql = "SELECT products.*, categories.cat_name 
 			FROM products 
			LEFT JOIN categories 
			ON products.cat_id = categories.cat_id	
			WHERE products.pro_id = $pro_id";
	
$result = mysqli_query($link, $sql);
$pro = mysqli_fetch_array($result);
$out_of_stock = ($pro['quantity']==0)?true:false;
?>
<div id="dialog-content">
 	<span id="dialog-pro-name" data-id="<?php echo $id; ?>"><?php echo $pro['pro_name']; ?></span>
<?php
	include "lib/IMGallery/imgallery-no-jquery.php";
	$sql = "SELECT * FROM images WHERE pro_id = $pro_id ORDER BY img_id ASC";
	$r = mysqli_query($link, $sql);
	$src = "read-image.php?img_id=";
	while($img = mysqli_fetch_array($r)) {
		$img_id = $img['img_id'];
		gallery_echo_img($src.$img_id);
	}
?>     
   	<span id="dialog-pro-detail"><?php echo $pro['detail']; ?></span>
    <?php if($out_of_stock) { echo '<span id="out-of-stock">สินค้าหมด</span>'; } ?>
    <span id="dialog-price"><b>ราคา:</b> <?php echo number_format($pro['price']); ?> บาท
        <span id="dialog-cat"><b>หมวดหมู่:</b> <?php echo $pro['cat_name']; ?></span>
    </span>
    
    <!-- ส่วนต่อไปนี้อยู่ใน form เพระต้องส่งขึ้นไปจัดเก็บเมื่อหยิบใส่รถเข็น -->
    <form id="dialog-form"> 
    <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
 	<?php
		$sql = "SELECT * FROM attributes WHERE pro_id = {$pro['pro_id']}";
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) > 0) {
			while($attr =mysqli_fetch_array($r)) {
				$name = $attr['attr_name'];
				$value = $attr['attr_value'];
				echo '<input type="hidden" name="prop_name[]" value="'.$name.'">';
				echo '<select name="prop_val[]">';		
				echo "<option>$name</option>";
				$values = explode(",", $value);
				foreach($values as $v) {
					echo "<option value=\"$v\">- $v</option>";
				}
				echo "</select>&nbsp;";
			}
		}
	?>
	
 	<b>จำนวน:</b> <input type="number" name="quantity" id="dialog-quantity" value="1" min="1">
    <button type="button" id="dialog-add-cart" data-id="<?php echo $id; ?>" <?php if($out_of_stock) { echo "disabled"; }?>>หยิบใส่รถเข็น</button>
    </form>
</div>
