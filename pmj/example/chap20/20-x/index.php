<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-x</title>
<style>
</style>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	/*
	var t = '<b>jQuery</b> is a <u><i>JavaScript</i></u> Library';
	$('div').html(t);
 	$('span').text(t);
	*/
	
	$('button').click(function() {
		$('li:first').after('<li>New Item</li>');
	});

});
</script>
</head>

<body>
	<!--
	<div>xxx</div>
	<span> </span>
    -->
 	<ul>
	 	<li>Item 1</li>
     	<li>Item 2</li>
 	</ul>
    <button>Add New Item</button>
</body>
</html>