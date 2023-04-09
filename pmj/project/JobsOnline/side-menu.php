	<div>&diams;&nbsp;ร่วมงานกับเรา</div>
	<a href="index.php">ตำแหน่งงาน</a>
<?php 
if(!isset($_SESSION['user']))  {
	echo '
	<a href="write-resume.php">เขียน Resume</a>
    <a href="login.php">Employer Login</a>
	';
}
else {
	echo '
    <a href="add-jobs.php">เพิ่มตำแหน่งงาน</a>
    <a href="list-resume.php">ตรวจสอบ Resume</a>
    <a href="logout.php">ออกจากระบบ</a>
	';
}
?>