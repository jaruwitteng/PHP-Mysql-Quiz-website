<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 20-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	form {
		display: inline-block;
	}
	textarea {
		width: 300px;
		height: 50px;
		background: #eff;
		border: solid 1px gray;
		padding: 3px;
		resize:none;
		overflow: auto;
	}
	div {
		margin-top: 10px;
		float: left;
	}
	button {
		float: right;

	}
	.clear {
		clear: both;
	}
</style>
<script src="../../../js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	$('button').click(function() {
		if($('textarea').val() == "") {
			alert('กรุณากำหนดข้อมูล');
		}
		else {
			alert('อัปเดตสถานะแล้ว');
		}
	});
});
</script>
</head>

<body>
<form>
 	<div>อัปเดตสถานะ:</div>
    <button type="button">ตกลง</button><br class="clear">
    <textarea name="status" placeholder=""></textarea>
</form>
</body>
</html>