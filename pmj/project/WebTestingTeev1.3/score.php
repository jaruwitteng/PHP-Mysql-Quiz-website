<?php
include "check-user.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing </title>

<style>
	@import "global2.css";
	table {
		border-collapse: collapse;
		margin: 15px auto 20px;
	}
	tr {
		border-bottom: solid 1px white;
	}
	th {
		background: lightblue;
		text-align: left;
	}
	th:nth-child(1) {
		width: 250px;;
	}
	th:nth-child(2) {
		width: 450px;
	}
	tr > *:nth-child(3), tr > *:nth-child(4) {
		width: 80px;
		text-align: center;
	}
	th, td {
		padding: 5px 1px;
		vertical-align: top;
	}
	tr:nth-of-type(odd) {
		background-color: #ddd;
	}
	tr:nth-of-type(even) {
		background-color: #cfc;
	}
</style>

<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {

});
</script>
</head>

<body>
<div class="nav">
	<?php include "header.php"; ?>
	</div>
<div id="container">

<article>

<section id="top">
	<h3>Results</h3>
    <span>Scores</span>
</section>

<section id="content">
<table>
<tr><th>Name</th><th>Subject</th><th>Questions</th><th>Score</th></tr>
<?php
include "dblink.php";
$testee_id = $_SESSION['testee_id'];
$sql = "SELECT * FROM score WHERE ";

$tid = 1;
if(isset($_SESSION['testee_id'])) {
	$tid = " testee_id = {$_SESSION['testee_id']}";
}
$sub = 1;
if(isset($_GET['subject_id'])) {
	$sub = " subject_id = {$_GET['subject_id']}";
}
$sql .= $tid . " AND " . $sub;

$result = mysqli_query($link, $sql);
while($data = mysqli_fetch_array($result)) {
	$sql = "SELECT CONCAT(firstname, '  ', lastname) FROM testee WHERE  testee_id = {$data['testee_id']}";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$name = $row[0];
	
	$subject_id = $data['subject_id'];
	$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$questions = $row[0];

	$sql = "SELECT subject_text FROM subject WHERE subject_id = $subject_id";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$subject = $row[0];
			
	echo "<tr>
				<td>$name</td><td>$subject</td><td>$questions</td><td>{$data['amount']}</td>
			</tr>";
}
mysqli_close($link);
?>
</table>
</section>

</article>

</div>
</body>
</html>