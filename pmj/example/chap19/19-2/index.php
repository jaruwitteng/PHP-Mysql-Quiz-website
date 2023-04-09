<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 19-2</title>
<script src="../../../js/jquery-2.1.1.min.js"> </script>
</head>

<body>
<form>
	<input type="checkbox" value="One">One
    <input type="checkbox" value="Two" checked>Two
    <input type="checkbox" value="Three">Three
    <input type="checkbox" value="Four" checked>Four
</form>
<script>
var text = "";
$(':checked').each(function() {
	text += $(this).val() + '\n';
});
alert('รายการที่เลือกคือ:\n' + text);
</script>

</body>
</html>