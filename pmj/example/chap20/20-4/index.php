<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$(':text').keypress(function(event) {
		var key = String.fromCharCode(event.which);	
		if(isNaN(key)) {
			event.preventDefault();
			alert('กรุณาใส่เฉพาะตัวเลข 0-9 เท่านั้น');	
		}
	});
});
</script>
</head>

<body>
 	ใส่เลขรหัสใต้ฝา:<input type="text">
 	<button>ส่ง</button>
</body>
</html>
