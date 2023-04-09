<?php
include "check-user.php";
if($_SESSION['user']=="tester") {
	header("location: index.php");
	exit;
}

include "dblink.php";
$testee_id = $_SESSION['testee_id'];
$subject_id = $_GET['subject_id'];
//ตรวจสอบว่าผู้ใช้รายนี้ได้ทำแบบทดสอบหัวข้อนี้หรือไม่
$sql = "SELECT COUNT(*) FROM testing WHERE subject_id = $subject_id AND testee_id = $testee_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$msg = "";
print_r ($row);
if($row[0] == 0) {
	mysqli_close($link);
	$msg = '<h3>
					<img src="images/no.png">
					ไม่พบข้อมูลการทำแบบสอบทดสอบของท่านในหัวข้อนี้
			 	</h3>';
}
else {	//ตรวจนับคะแนน
	$sql = "SELECT COUNT(*) FROM testing
				WHERE subject_id = $subject_id AND testee_id = $testee_id AND choice_id IN(
					SELECT choice_id 
					FROM choice 
					WHERE  subject_id = $subject_id AND answer = 'yes')";
			
	$result =  mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
	$score = $row[0];

	$sql = "REPLACE INTO score VALUES($testee_id, $subject_id, $score)";
	mysqli_query($link, $sql);

	$sql = "DELETE FROM testing WHERE testee_id = $testee_id AND subject_id = $subject_id";
	mysqli_query($link, $sql);
				
	mysqli_close($link);
	$msg = '<h3>
					<img src="images/ok.png">
					เสร็จสิ้นการทดสอบและตรวจนับคะแนนแล้ว
				</h3>';
}
header("refresh:5; url=index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing: Finish</title>
<style>
	html {
		cursor: wait;		
	}
	body {
		text-align: center;
	}
	h3 img {
		margin-right: 3px;
		vertical-align: middle;
	}
</style>
</head>

<body>
<?php echo $msg; ?>
<h4>จะกลับไปยังหน้าหลักใน 5 วินาที</h4>
</body>
</html>