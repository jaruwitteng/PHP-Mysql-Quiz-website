<?php
session_start();
include("dblink.php");
	
$a = array();
//หากมีข้อมูลอยู่ในเซสชั่น(เคยหยิบสินค้ามาแล้ว) ให้นำข้อมูลนั้นออกมาใช้
if(isset($_SESSION['cart'])){
	$a = $_SESSION['cart'];
}

$id = $_POST['id'];
$sql = "SELECT * FROM shopping_cart WHERE item_id = '$id'";
$rs = mysqli_query($link, $sql);
$data = mysqli_fetch_array($rs);

$name = $data['name'];
$id = $data['item_id'];

//ถ้าไม่เคยหยิบสินค้านั้นใส่ในรถเข็นมาก่อน
if(!in_array($name, $a)){
	//นำค่า id และชื่อสินค้ามาสร้างเป็นอาร์เรย์
	//โดยเติม x ไว้ข้างหน้า id เพื่อไม่ให้คีย์เป็นตัวเลขล้วนๆ
	//ซึ่งอาจเกิดปัญหา ในกรณีการแปลงข้อมูลระหว่าง JSON และอาร์เรย์
	$b = array("x$id"=>"$name");
	
	//ผนวกอาร์เรย์ของสินค้าหยิบใหม่กับของเก่าเข้าด้วยกัน
	$a = array_merge($a, $b);
}		

$_SESSION['cart'] = $a; //จัดเก็บข้อมูลกลับเข้าไปในเซสชั่นตามเดิม

mysqli_close($link);
sleep(1);
?>