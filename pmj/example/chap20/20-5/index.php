<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-5</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	div {
		border: solid red 2px;
		cursor: default;
		padding: 10px;
	}
	img {
		border: solid 2px blue;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('div').click(function(event) {
		alert('You clicked div');
		//event.stopPropagation();
	});
	
	$('img').click(function(event) {
		alert('You clicked image');
		//event.stopPropagation();
	});
});
</script>
</head>

<body>
	<div><img src="jquery.jpg"></div>
</body>
</html>
