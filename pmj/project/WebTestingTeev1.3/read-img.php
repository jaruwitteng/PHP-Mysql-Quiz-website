<?php
include "dblink.php";
$question_id = $_GET['question_id'];
$sql = "SELECT image FROM question WHERE question_id = $question_id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_array($result);
header("Content-Type: image/jpeg");
echo $data['image'];
@mysqli_close($link);
?>