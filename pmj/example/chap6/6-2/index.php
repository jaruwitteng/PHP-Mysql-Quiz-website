<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 6-2</title>	
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		color: navy;
		text-align: center;
	}
	[name=keyword] {
		width: 150px;
		background: #ffc;
		border: solid 1px gray;
		border-right: none !important; 
		border-radius: 4px 0px 0px 4px; 
		margin-right: -3px;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px gray;
		border-left: none !important; 
		border-radius: 0px 4px 4px 0px; 
		font-weight: bold;
		margin-left: -3px; 
		height: 28px;
	}
	h4 > span {
		color: red;
	}
</style>
</head>

<body>
<form method="get">
	ค้นหา: <input type="text" name="keyword">
	<button>ตกลง</button>
</form> 
<?php
if($_GET) {
		$k = $_GET['keyword'];
		echo "<h4>ผลการค้นหา: <span>$k</span></h4>";
}	
?>
</body>
</html>