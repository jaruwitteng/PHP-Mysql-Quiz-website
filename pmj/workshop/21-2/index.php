<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 21-2</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	h3 {
		text-align: center;
	}
	h3 > img {
		vertical-align: middle;
		margin: 0px 5px;
	}
	div.item-container {
		width: 500px;
		border: solid 1px silver;
		background: #dee;
		margin: auto;
	}
	.img-item {
		float: left;
		width: 60px;
		height: 60px;
		margin: 10px;
		border-radius: 5px;
	}
	.img-star {
		vertical-align: middle;
		margin-right: 2px;
	}
	.img-star:last-child {
		margin-right: 5px;
	}
	span.item-name {
		display: block;
		font-weight: bold;
		color: green;	
		margin-top: 10px;
	}
	div.rating {
		border-top: dotted 1px #aaa;
		display: inline-block;
		width: 100%;
	}
	div.rating > span:first-child {
		display: inline-block;
		padding: 3px 4px;
	}
	div.rating > span:last-child {
		display: inline-block;
		float: right;
		padding: 2px 4px;
		border-left: dotted 1px #aaa;
	}
	button.bt-rate {
		background: orange;
		border: solid 1px gray;
		border-radius: 3px;
		color: white;
		margin: 3px 0px 2px;
	}
	button.bt-rate:hover {
		color: aqua;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	
	$('button.bt-rate').click(function() {
		var item_id = $(this).attr('data-id');	
		var num_star = $(this).parent().find(':radio:checked').val();
		
		$.ajax({
			url:'rating.php',
			data:{'item_id':item_id, 'num_star':num_star},
			dataType:'html',
			type:'post',
			beforeSend:function() {
				$.blockUI();
			},
			success:function(result) {
				if(result.length == 0) {
					updateStar(item_id);
				}
				else {
					alert(result);
				}
			},
			complete:function() {
				$.unblockUI();
			}
		});
	});
});

function updateStar(item_id) {
	$.ajax({
		url:'update-star.php',
		data:{'item_id':item_id},
		dataType:'html',
		type:'post',
		success:function(result) {
			$('#star-img-' + item_id).html(result);
		}
	});	
}
</script>
</head>

<body>
<h3><img src="image-star/full-star.png">Star Rating <img src="image-star/full-star.png"></h3>
<?php
include "dblink.php";
$sql = "SELECT * FROM rating_item";
$rs = mysqli_query($link, $sql);
while($data = mysqli_fetch_array($rs)) {
	$id = $data['item_id'];
?>
<div class="item-container">
	<img src="image-item/<?php echo $data['image']; ?>" class="img-item">
	<span class="item-name"><?php echo $data['name']; ?></span>
    <span class="item-detail"><?php echo $data['detail']; ?></span>
	<div class="rating">
		<span class="star-img" id="star-img-<?php echo $id; ?>">
        	<script> updateStar(<?php echo $id; ?>); </script>
        </span>
        <span class="star-rate">
        Star:
        <input type="radio" name="star_<?php echo $id; ?>" value="1"  checked>1
        <input type="radio" name="star_<?php echo $id; ?>" value="2">2
        <input type="radio" name="star_<?php echo $id; ?>" value="3">3
        <input type="radio" name="star_<?php echo $id; ?>" value="4">4
        <input type="radio" name="star_<?php echo $id; ?>" value="5">5
        <button class="bt-rate" data-id="<?php echo $id; ?>">Rate</button>
      </span>
	</div>
</div><br>
<?php
}
mysqli_close($link);
?>
</body>
</html>