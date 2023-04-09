<?php 
session_start();
if(!isset($_SESSION['admin'])) {
	header("location:login.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 21-3</title>
<style>	
 	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
		margin-top: 20px;
		min-width: 600px;
	}
	table {
		border-collapse: collapse;
		margin: auto;
		width: 450px;
	}
	tr:first-child td {
		background: green;
		color: yellow;
		text-align: center;
		font-weight: bold;
		
	}
	tr:nth-of-type(odd) {
		background: #ee9;
	}
	tr:nth-of-type(even) {
		background: #cee;
	}	
	td {
		border: solid 1px white;
		padding: 3px;
	}
	td:nth-child(1) {
		width: 50px;
	}
	td:nth-child(2) {
		width: 200px;
		text-align: left;
	}
	td:nth-child(3) {
		width: 50px;
	}
	td:nth-child(4) {
		width: 150px;
	}
	td > img {
		width: 24px;
	}
	td > button {
		width: 60px;
		margin: 0px 2px;
	}
	caption {
		text-align: left;
	}
	caption > a {
		float: right;
		text-decoration: none;
		padding-right: 5px;
		color: blue;
	}
	caption > a:hover {
		color:red;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('td > button').click(function() {
		var id = $(this).attr('data-id');
		var action = $(this).text();
			$.ajax({
				url:'action.php',
				type:'post',
				data:{'id':id, 'action':action},
				beforeSend: function() {
					$.blockUI();
				},
				success: function() {
					document.location.reload();	//หลังการเปลี่ยนแปลง ให้โหลดเพจนั้นมาแสดงใหม่
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
<table>
<?php
include "dblink.php";
include "lib/pagination.php";

$sql ="SELECT * FROM poll_topic ORDER BY topic_id DESC";
$rs = page_query($link, $sql, 10);

$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}

echo "<caption>โพลลำดับที่: $first - $last จากทั้งหมด $total
 		<a href=\"index.php\">หน้าหลัก</a> <a>-</a> <a href=\"new-topic\">เพิ่มหัวข้อโพล</a></caption>"; 
		
echo "<tr><td>id</td><td>หัวข้อ</td><td>สถานะ</td><td>คำสั่ง</td></tr>";

while($data = mysqli_fetch_array($rs)) {
	echo "<tr>";
	echo "<td>".$data['topic_id']."</td>";
	echo "<td>".$data['topic_text']."</td>";
	$src = "no.png";
	if($data['status']=="active") {
		$src = "ok.png";
	}
	echo "<td><img src=\"images/$src\"></td>";
	echo '<td><button data-id="'.$data['topic_id'].'">';
	
	if($data['status']=="active") {
		echo "inactive";
	}
	else {
		echo "active";
	}
	echo "</button>";
	echo '<button data-id="'.$data['topic_id'].'">delete</button>';
	echo "</td>";
	echo "</tr>";
}
?>
</table>
<?php
if(page_total() > 1) { 	
	echo '<p id="pagenum">';
	page_echo_pagenums();
	echo '</p>&nbsp;';
}
mysqli_close($link);
?>
</body>
</html>