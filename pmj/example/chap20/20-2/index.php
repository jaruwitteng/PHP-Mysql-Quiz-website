<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-2</title>
<style>
	img {
		border: solid 2px blue;
		cursor: pointer;
		vertical-align: text-bottom;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	$('button').click(function() {
		alert("jQuery logo");
	});
	
	$('img').click(function() {
		$('button').click();
	});
	
	/*
	$('button, img').click(function() {
		alert("jQuery logo");
	});
	*/
});
</script>
</head>

<body>
 	<img src="jquery.jpg">
 	<button type="button">รายละเอียด</button>
</body>
</html>