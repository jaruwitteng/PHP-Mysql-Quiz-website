<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example HTML5 Elements</title>
<style>
	* {
		font: 14px tahoma;
	}
	[type=number] {
		width: 50px;
	}
	[type=range] {
		width: 100px;
	}
	div {
		width: auto;
		display: inline-block;
	}
	div > input {
		width: 200px;
		background: #ffc;
		border: solid 1px gray;
		margin-bottom: 5px;
	}
	 label {
		display: inline-block;
		width: 60px;
	}
	div > button {
		float: right;
		background: steelblue;
		color: white;
		border:solid 1px orange;
		border-radius: 5px;
		padding: 2px 10px;
	}
	[type=date], [type=time] {
		background: #ffc;
		border: solid 1px gray;
	}
</style>
</head>

<body>
<form>
<!--
<label>Number:</label> <input type="number" name="ชื่อ" value="ค่าเริ่มต้น" min="ค่าต่ำสุด" max="ค่าสูงสุด"><br><br>
<label>Range: </label><input type="range" name="ชื่อ" value="ค่าเริ่มต้น" min="ค่าต่ำสุด" max="ค่าสูงสุด">
-->
<!--
วันที่: <input type="number" name="date" 
 	min="1" max="31">
    <button>ส่งข้อมูล</button>
 -->
 <!--
 ระดับเสียง: 0 <input type="range" name="volume" 
 		min="0" max="10"> 10
  -->
  <!--
<div>
   	<label>email:</label><input type="email" name="email" size="40"><br>
  	<label>url:</label><input type="url" name="url" size="40"><br>
  	<label>tel:</label><input type="tel" name="tel" size="40"><br>
    <button>ส่งข้อมูล</button>
</div>
  -->
  <!-- 
<input type="date" name="date">
<input type="time" name="time">
-->
  <!--
<input type="color" name="bgcolor">
-->
</form>
</body>
</html>