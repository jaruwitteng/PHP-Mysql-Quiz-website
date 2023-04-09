<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example Required</title>
<style>
	* {
		font: 14px tahoma;
	}
	[name=keyword] {
		background: #ffc;
		border: solid 1px gray;
		border-radius: 3px;
		/*border-right: none !important; */
		/*border-radius: 5px 0px 0px 5px; */
		padding: 2px 3px;
		/*margin-left: 0px; */
	}
	button {
		background: #F60;
		color: white;
		border: solid 1px gray;
		border-radius: 3px;
		/*border-left: none !important; */
		/*border-radius: 0px 5px 5px 0px; */
		padding: 2px 5px;
		font-weight: bold;
		/*margin-right: 0px; */
	}
</style>
</head>

<body>
<form action="form-echo.php">
	ค้นหา: <input type="text" name="keyword" required>
    <button>ค้นหา</button>
</form>
</body>
</html>