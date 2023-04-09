<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 9-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		min-width: 500px;
	}
	fieldset {
		width: 450px;
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
		display: inline-block;
		width: auto;
		text-align: left;
	}
	form > * {
		margin: 3px;
	}
	[name=keyword] {
		width: 300px;
	}
	[name=keyword], select {
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 2px;
	}
	button {
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 3px;
		padding: 2px 15px;
		margin-right: 10px;
		float: right;
	}
	div {
		width: 500px;
		background: #def;
		border: solid 1px skyblue;
		padding: 10px;
		border-radius: 4px;
		margin: auto;	
		text-align: left;
	}
	br.clear {
		clear: right;
	}
</style>
</head>

<body>
<?php
if(isset($_GET['keyword'])) {		//ถ้าเป็นการ Postback
	$search = $_GET['search'];
	$kw = $_GET['keyword'];
	$match = $_GET['match'];
	$price = $_GET['price'];
	$field = implode(", ", $_GET['field']);	//รวมให้เป็นสตริงเดียวกันคั่นด้วย ", "
		
	//จัดวางสัญลักษณ์ wildcard ให้สอดคล้องกับตำแหน่งคำที่เลือก
	if($match == "part") {
		//ถ้าเลือกส่วนใดส่วนหนึ่งของคำ ให้แทนที่ช่องว่างระหว่างคำด้วย %
		//เพื่อให้สามารถมีข้อความอื่นแทรกอยู่ระหว่างคำเหล่านี้ได้
		$kw = preg_replace("/[ ]{1,}/i", "%", $kw);
		$kw = "%".$kw."%";
	}
	else if($match == "start") {
		$kw = "$kw%";
	}
	else if($match == "end") {
		$kw = "%$kw";
	}
		
	//นำค่าจากตัวแปรต่างๆมาแทรกลงใน SQL
	$sql = "SELECT 	$field FROM  book
				WHERE	($search  LIKE  '$kw') AND (price  $price)";
					
	//สามารถนำคำสั่ง  SQL ที่ได้นี้ไปใช้ร่วมกับฟังก์ชัน mysql_query() ได้เลย
	
	echo "ตัวอย่างคำสั่ง SQL ที่ได้:";
	echo "<div>".nl2br($sql)."</div>";
	echo "<p><a href=\"javascript: history.back();\">ย้อนกลับ</a></p>";
	echo "</body></html>";
	exit;
}
?>
<fieldset><legend>ระบบสืบค้นหนังสือ</legend>
<form method="get">
    <input type="radio" name="search" value="title" checked>ชื่อหนังสือ
    <input type="radio" name="search" value="author">นักเขียน
    <input type="radio" name="search" value="publisher">สำนักพิมพ์
    <br>
    <input type="text" name="keyword" required>
    
    <br>
    <select name="match">
    <option value="part">ส่วนของคำ</option>
    <option value="whole">ตรงกันทั้งคำ</option>
    <option value="start">ขึ้นต้นด้วย</option>
    <option value="end">ลงท้ายด้วย</option>
  </select>
  
    <select name="price">
  	<option value="> 0">ทุกระดับราคา</option>
  	<option value="<= 200">ไม่เกิน 200</option>
  	<option value="BETWEEN 200 AND 250">200 - 250</option>
  	<option value="BETWEEN 250 AND 300">250 - 300</option>
  	<option value="BETWEEN 300 AND 400">300 - 400</option>
  	<option value=">= 400">400 ขึ้นไป</option>
	</select>
	<button>ค้นหา</button><br class="clear">
    
  	ข้อมูลที่แสดงในผลลัพธ์:<br>
  	<input type="checkbox" name="field[]" value="title" checked required>ชื่อหนังสือ
  	<input type="checkbox" name="field[]" value="author" checked required>นักเขียน
  	<input type="checkbox" name="field[]" value="publisher" checked required>สนพ.
  	<input type="checkbox" name="field[]" value="price" checked>ราคา
  	<input type="checkbox" name="field[]" value="isbn" checked>ISBN
</form>
</fieldset>
</body>
</html>