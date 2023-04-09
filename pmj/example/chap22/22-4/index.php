<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 22-4</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		min-width: 500px;
	}
	img.pic {
		width: 80px;
		float:left;
		margin-right: 5px;
		border-radius: 7px;
	}
	div.detail {
		width: 300px;
		float:left;
		font: 10pt tahoma;
	}
	div.detail > span {
		font: bolder 14px tahoma;
		color: red;
	}
	br.clear {
		clear: left;
	}
	table.tb-detail td:nth-child(1) {
		width: 100px;
		background: powderblue;
		vertical-align: top;
		font-weight: bold;
		padding: 3px;
	}
	table.tb-detail td:nth-child(2) {
		width: 350px;
		background: wheat;
		vertical-align: top;
		padding: 3px;
	}
	table.tb-detail img {
		border-radius: 7px;
	}
</style>
<link href="../../../js/jquery-ui.min.css" rel="stylesheet">
<script src="../../../js/jquery-2.1.1.min.js"> </script>
<script src="../../../js/jquery-ui.min.js"> </script>
<script src="../../../js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('div.detail > a').click(function(event) {
		var id = event.target.id;
		$.ajax({
			url: 'full-details.php',
			data: {'id': id},
			success: function(result) {
				var div = $("<div></div>");
				div.html(result).dialog({title: 'ข้อมูลสินค้า', width: 500, modal:true});
				$('.ui-dialog-titlebar-close').focus();
			},
			beforeSend: function() {
				$.blockUI({message: '<h3>Loading...</h3>'});
			},
			complete: function() {
				$.unblockUI();
			}
		});
	});
});
</script>
</head>

<body>
<?php
 	include "data.php";
	//สมมติให้รหัสสินค้ามีค่าระหว่าง 1-5
	for($i=1; $i <= 5; $i++) {
		echo '
			<img src="pics/'.$images[$i][0].'" class="pic">
			<div class="detail">
			 	<span>'.$names[$i].'</span><br>'.
				/* รายละเอียดเอาแค่อักขระ 150 ตัวแรก และเอารหัสสินค้าเป็นค่า id ของลิงก์  */
				mb_substr($details[$i], 0, 150, 'utf-8').  
				'...<br><a href=# id="'.$i.'">รายละเอียดทั้งหมด</a>  
			</div>
			<br class="clear"><br>
		';
	}
?>
</body>
</html>
