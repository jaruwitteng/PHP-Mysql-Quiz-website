<?php
include "dblink.php";
	
$item_id = $_POST['item_id'];

//คำสั่ง SQL ต่อไปนี้้เราจะอ่านค่าเฉลี่ยและจำนวนผู้ให้ดาวทั้งหมดของสินค้ารายการนั้น
$sql = "SELECT AVG(star), COUNT(*) FROM rating_star WHERE item_id = '$item_id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);
$score = $data[0];
$giver =  $data[1];   

$full_star = intval($score); 

$half_star = 0;
$f = $score - intval($score);   //เศษส่วน
if($f >= 0.25 && $f <= 0.75) {
	$half_star = 1;
}
else if($f > 0.75) {
	$full_star += 1;
}
$empty_star = 5 - ($full_star + $half_star);

echo_star($full_star, "full-star.png");
echo_star($half_star, "half-star.png");
echo_star($empty_star, "empty-star.png");

echo "(".number_format($giver).")";

mysqli_close($link);
	
function echo_star($num_star, $src) {
	for($i = 1; $i <= $num_star; $i++) {
		echo '<img src="image-star/'.$src.'" class="img-star">';
	}
}
?>