<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example RegEx</title>
<style>
	* {
		font: 14px tahoma;
	}
	input {
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 2px 5px;
	}
	button {
		background: #F60;
		color: white;
		border: solid 1px gray;
		border-radius: 3px;
		padding: 2px 10px;
		margin-left: 3px;
	}
</style>
</head>

<body>
<form method="post">
	รหัสใต้ฝา: <input type="text" name="code" 
     				pattern="[0-9]{10}" title="ใส่ตัวเลข 0-9 จำนวน 10 ตัว">
                    <button>OK</button>
 </form>
</body>
</html>