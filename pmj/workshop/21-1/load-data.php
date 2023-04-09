<?php
sleep(2);

include "dblink.php";

$start = $_POST['start_row'];
$row_count = $_POST['row_count'];
if($start <= 100) {
	$sql = "SELECT * FROM scroll_update ORDER BY id LIMIT $start_row, $row_count";
	$rs = mysqli_query($link, $sql);

	while($data = mysqli_fetch_array($rs)) {
		echo "<div class=\"msg\">{$data['message']}</div>";
	}
}
mysqli_close($link);
?>