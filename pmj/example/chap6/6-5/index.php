<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 6-5</title>
<style>
	* {
		font:  14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	form {
		width: 300px;
		background: #dff;
		border: solid 1px gray;
		border-radius: 4px;
		padding: 10px;
		margin: auto;
	}
	[type=text] {
		width: 200px;
		padding: 2px;
		margin-bottom: 3px;
	}
	select {
		width: 100px;
	}
	[type=text], select {
		background: #ffc;
		border: solid 1px gray;		
		border-radius: 3px;
	}
	label {
		font-weight: bold;
	}
	div {
		width: 180px;
		display: inline-block;
	}
	button {
		float: right;
		background: steelblue;
		color: white;
		border: solid 1px gold;		
		border-radius: 3px;
		padding: 3px 10px;
		font-weight: bold;
	}
	button:hover {
		background: aqua;
		color: red;
	}
</style>
</head>

<body>
<?php
if($_POST) {
 	echo "<label>ที่อยู่:</label><br>";
 	foreach($_POST['address'] as $address) {
	 	echo $address . "<br>";
 	}

 	if($_POST['hobbies']) {
		echo "<br><label>งานอดิเรก:</label> ";
	 	//เนื่องจากข้อมูลที่ส่งมาอยู่ในรูปแบบอาร์เรย์
	 	//เราจึงสามารถรวมสมาชิกให้เป็นสตริงเดียวกันได้ด้วย implode()
	 	$hobby = implode(", ", $_POST['hobbies']);  	//คั่นด้วย ", "
	 	echo $hobby;
 	}
	
	//ตัวเลือก multiple selection ต้องตรวจสอบก่อน เพราะผู้ใช้อาจไม่เลือกรายการใดเลยก็ได้
 	if($_POST['pets']) {
		echo "<br><br><label>สัตว์เลี้ยงที่ชอบ:</label> ";
	 	$pets = implode(", ", $_POST['pets']);		//คั่นด้วย "<br>" หรือให้แยกไว้คนละบรรทัด
	 	echo $pets;
 	}
	//หลังการแสดงผล จะไม่แสดงฟอร์มอีก ดังนั้นจะหยุดการทำงานของเพจ
 	exit("</body></html>");
}
?>

<form method="post">
  	<label>ที่อยู่</label><br>
  	บรรทัดที่ 1: <input type="text" name="address[]"> <br>
	บรรทัดที่ 2: <input type="text" name="address[]"> <br>
	บรรทัดที่ 3: <input type="text" name="address[]"> <br><br>
    
	<label>งานอดิเรก</label>
	<input type="checkbox" name="hobbies[]" value="ดูหนัง">ดูหนัง
	<input type="checkbox" name="hobbies[]" value="ฟังเพลง">ฟังเพลง
    <input type="checkbox" name="hobbies[]" value="นอน">นอน<br><br>
 	
	<label>สัตว์เลี้ยงที่ชอบ</label><br>
 	<select name="pets[]" multiple>
   		<option value="สุนัข">สุนัข</option>
   		<option value="แมว">แมว</option>
   		<option value="ปลา">ปลา</option>
        <option value="นก">นก</option>
	</select> 
    <div><button>ส่งข้อมูล</button></div>
</form>
</body>
</html>