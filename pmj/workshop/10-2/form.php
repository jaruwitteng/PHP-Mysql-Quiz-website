<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 10-2</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 500px;
	}
	fieldset {
		width: 360px;
		margin: auto;
		background: #def;
		border-radius: 4px
	}
	legend {
		text-align: left;
		font-size: 18px;
		color: navy;
	}
	form {
		text-align: left;
	}	
	label {
		display: inline-block;
		width: 60px;
		text-align: right;
	}
	label.float {
		float: left;
		margin-right: 4px !important;
	}
	input, select {
		width: 250px;
	}
	textarea {
		float: left;
		width: 250px;
		height: 40px;
		resize: none;
		overflow: auto;
	}
	input, textarea, select {
		background: #ffc;
		border: solid 1px gray;
		margin: 3px;
		padding: 3px;
		border-radius: 2px;	
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 3px 20px;
		margin-left: 10px;
	}
	[readonly] {
		width: 100px;
		background: #ccc;
		border-color: #999;
		color: gray;
	}
	br.clear {
		clear: left;
	}
	h3, p {
		text-align: center;
	}
</style>
</head>

<body>
<?php
$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</body></html>");

//ถ้าเป็นการ Postback เพื่อส่งข้อมูลจากฟอร์มกลับเข้ามา
if(isset($_POST['id'])) {
	//นำข้อมูลจากตัวแปร $_POST ที่เหลือมาเรียงต่อเป็นสตริงเดียวกัน โดยคั่นด้วย ', '
	$values = implode("', '", $_POST);  //ลักษณะผลลัพธ์ เช่น a', 'b', 'c', 'd
	
	//ปิดหัวท้ายด้วย ' เพื่อให้ครบคู่ ลักษณะผลลัพธ์จะเป็น 'a', 'b', 'c', 'd'
	$values = "'" . $values . "'";
	
	//นำข้อมูลนั้นมาสร้างเป็น SQL ในแบบคำสั่ง REPALCE
	$sql = "REPLACE INTO people VALUES($values)";
	$replace = mysqli_query($link, $sql);
	if(!$replace) {
		echo mysqli_error($link);
	}
	else {
		echo "<h3>ข้อมูลถูกบันทึกแล้ว</h3>";
		back();
	}
}

// ------------------------------------------------------------------
//ส่วนต่อไปนี้สำหรับการเชื่อมโยงมาจากเพจแสดงข้อมูล(index.php)
if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	//ถ้าเป็นเพิ่มข้อมูล ก็ไม่ต้องทำอะไร เพื่อให้ฟอร์มนั้นว่างเปล่าสำหรับรับข้อมูลใหม่
	if($action == "insert") {
		$h = "เพิ่มข้อมูล";
	}
	//ถ้าเป็นการลบ ก็นำค่า id ไปกำหนดเป็นเงื่อนไขการลบ
	else if($action == "delete") {
		$id = $_GET['id'];
		$delete = mysqli_query($link, "DELETE FROM people WHERE id = $id");
		if(!$delete) {
			echo mysqli_error($link);
		}
		else {
			echo "<h3>ข้อมูลถูกลบแล้ว</h3>";
		}
 		back();
	}
	//ถ้าเป็นการแก้ไขข้อมูล ต้องอ่านข้อมูลเดิมมาเติมลงในฟอร์ม
	else if($action == "update") {		
		$id = $_GET['id'];
		$h = "แก้ไขข้อมูล";
		$result = mysqli_query($link, "SELECT * FROM people WHERE id = $id");
		$data = mysqli_fetch_array($result);
	}
}
function back() {
	global $link;
 	mysqli_close($link);
	exit("<p><a href=\"index.php\">ย้อนกลับ</a></p></body></html>");
}
mysqli_close($link);
?>
<fieldset><legend><?php echo $h; ?></legend>
<form method="post">
		
		<label>id</label>
		<input type="text" name="id" value="<?php echo $data['id']; ?>" placeholder="ไม่ต้องระบุ" readonly><br>
        
		<label>name</label>
       <input type="text" name="name" value="<?php echo $data['name']; ?>"><br>
	
    	<label class="float">address</label>
       	<textarea name="address"><?php echo $data['address']; ?></textarea><br class="clear">
        
 		<label>email</label>
      	<input type="email" name="email" value="<?php echo $data['email']; ?>"><br>
        
		<label>birthday</label>
       	<input type="date" name="birthday" value="<?php echo $data['birthday']; ?>"> <br><br>
        
       <label>&nbsp;</label><button>ส่งข้อมูล</button>
       
       &nbsp;&nbsp;<a href="index.php">ย้อนกลับ</a>
</form>
</fieldset>
</body>
</html>
