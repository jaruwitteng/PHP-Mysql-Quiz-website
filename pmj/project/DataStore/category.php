<?php 
include "check-login.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Store</title>
<style>
	@import "global.css";

	table {
		width: auto;
		border-collapse: collapse;
		margin: auto;
		margin-top: 5px;
	}
	caption {
		text-align: left;
		padding-bottom: 3px;
	}
	caption button {
		float: right;
	}
	#c1 {
		width: 100px;
	}
	#c2 {
		width: 350px;
	}
	#c3 {
		width: 150px;
	}
	table th {
		background: green;
		color: yellow;
		padding: 5px;
		border-right: solid 1px white;
		font-size:12px;
	}
	tr:nth-of-type(odd) {
		background: lavender;
	}
	tr:nth-of-type(even) {
		background: whitesmoke;
	}
	td {
		vertical-align: middle;
		padding: 3px 0px 3px 10px;
		border-right: solid 1px white;
	}
	td:nth-child(odd) {
		text-align: center;
	}
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {
	$('#add-cat').click(function() {
		var cat = prompt("กรุณากำหนดชื่อหมวด", "");
		if(cat) { 	
		 	ajaxSend({'action': 'add', 'cat':cat});  
		}
	});

	$('button.edit').click(function() {
		var cat = prompt("กรุณากำหนดชื่อใหม่สำหรับหมวดนี้", "");
		if(cat) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'edit', 'cat':cat, 'cat_id': id});
		}
	});	
	
	$('button.del').click(function() {
		if(confirm("ยืนยันที่จะลบหมวดนี้")) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'del', 'cat_id': id});
		}
	});
		
});
function ajaxSend(dataJSON) {
	$.ajax({
		url: 'category-action.php',
		data: dataJSON,
		type: 'post',
		dataType:"html",
		beforeSend: function() {
			$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
		},
		success: function(result) {
				
		},
		complete: function() {
			$.unblockUI();
			location.reload();
		}
	});
}
</script>
</head>

<body><?php include "top.php"; ?>

<article>
<?php
include "dblink.php";
include "lib/pagination.php";

$sql = "SELECT * FROM categories";
$result = page_query($link, $sql, 20);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
?>
<table>
<caption>
	<?php 	echo "หมวดหมู่ลำดับที่  $first - $last จากทั้งหมด $total"; ?>
	<button id="add-cat">เพิ่มหมวดหมู่</button>
</caption>
<colgroup><col id="c1"><col id="c2"><col id="c3"></colgroup>
<tr><th>รหัส</th><th>ชื่อหมวดสินค้า</th><th>คำสั่ง</th></tr>
<?php
while($cat = mysqli_fetch_array($result)) {
?>
<tr>
 	<td><?php echo $cat['cat_id']; ?></td>
    <td><?php echo $cat['cat_name']; ?></td>
    <td>	
     		<button class="edit" data-id="<?php echo $cat['cat_id']; ?>">แก้ไข</button>
     		<button class="del" data-id="<?php echo $cat['cat_id']; ?>">ลบ</button>
    </td>
</tr>
<?php
}
?>
</table>
<?php
if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
	echo '<p id="pagenum">';
	page_echo_pagenums();
	echo '</p>';
}
?>
</article>
</body>
</html>