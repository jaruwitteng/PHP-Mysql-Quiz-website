<?php 
session_start(); 

if(!isset($_SESSION['user']) && !isset($_SESSION['resume_id'])) {
	exit;
}
if(!isset($_GET['rid']) && !isset($_SESSION['resume_id'])) {
	echo "Resume ID Required!";
	exit;
}
$rid = 0;
if(isset($_GET['rid']) ) {
	$rid = $_GET['rid'];
}
else if(isset($_SESSION['resume_id'])) {
	$rid = $_SESSION['resume_id'];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
<style>
	* {
		font-family: tahoma;
	}
	article {
		border: solid 0px;
		width: 800px;
		margin: 30px auto;
	}
	aside#left {
		float: left;
		width: 650px;
	}
	aside#right {
		float: left;
	}
	div {
		display: inline-table;
		color: navy;
		padding: 3px;
		border: solid 0px gray;
		background: #ddf;
		margin: 3px 0px 0px;
		font-size: 14px;
	}
	form {
		padding-left: 15px;
		padding-bottom: 30px;
	}
	div > span {
		color: brown;
		font-weight: bold;
		text-decoration: none;
		margin-right: 5px;
		font-size: inherit;
	}
	div > span::after {
		content: ':';
	}
	div.name {
		font-size: 22px;
		width: 460px;
		color: navy
	}
	div.age {
		font-size: 22px;
		width: 140px;
	}
	div.address {
		width: 610px;
		height: 40px;
		resize: none;
	}
	div.phone {
		width: 250px;
	}
	div.email {
		width: 350px;
	}
	aside#right img {
		margin-top: 3px;
		max-height: 120px;
		max-width: 120px;
	}
	section {
		width: 790px;
		border-bottom: dotted 1px gray;
		font-weight: bold;
		font-size: 16px;
		color: green;
	}
	div.expect-jobs {
		width: 490px ;
	}
	div.salary {
		width: 280px;	
	}
	div.position {
		width: 255px;
	}
	div.workplace {
		width: 370px;	
	}
	div.period {
		width: 135px;	
	}
	div.level {
		width: 150px;
	}
	div.academy {
		width: 360px;
	}
	div.major {
		width: 250px;
	}
	div.lang {
		width: 373px;
	}
	div.drive {
		width: 125px;
	}
	div.full {
		width: 780px;
	}
	br.clear { clear: both; }
</style>
</head>

<body>
<?php
	include "dblink.php";
	$sql = "SELECT * FROM resume WHERE resume_id = $rid";
	$result = mysqli_query($link, $sql);
	$resume = mysqli_fetch_array($result);
	
	$name = $resume['name'];
	$address = $resume['address'];
	$phone = $resume['phone'];
	$email = $resume['email'];
	$age = $resume['age'];
	if(is_numeric($age)) {
		$age .= " ปี";
	}
?>
<article>
	<aside id="left">
	<div class="name long"><span>ชื่อ</span><?php echo $name; ?></div>
    <div class="age"><span>อายุ</span><?php echo $age; ?></div><br>
    <div class="address"><span>ที่อยู่</span><?php echo $address; ?></div><br>
    <div class="phone"><span>โทร</span><?php echo $phone; ?></div>
    <div class="email"><span>อีเมล์</span><?php echo $email; ?></div>
    </aside>
    
<?php
	$sql = "SELECT COUNT(*) FROM image WHERE resume_id = $rid";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$src = "images/no-photo.jpg";
	if($row[0] != 0) {
		$src = "read-img.php?id=$rid";
	}
?>
	<aside id="right">
    	<img src="<?php echo $src; ?>">
     </aside>
    <br class="clear"><br>
<?php
	$expect_jobs = $resume['expect_jobs'];
	$salary = $resume['expect_salary']; 
?>   
    <section>ตำแหน่งงานและเงินเดือนที่คาดหวัง</section>
    <div class="expect-jobs"><span>ตำแหน่งงาน</span><?php echo $expect_jobs; ?></div>
    <div class="salary"><span>เงินเดือน</span><?php echo $salary; ?></div>
    <br><br>
    
<?php
		$sql = "SELECT * FROM experience WHERE resume_id = $rid AND LENGTH(position) > 0 ORDER BY exp_id ASC";
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) > 0) {
			echo "<section>ประวัติการทำงาน (ตำแหน่ง-สถานที่-ระยะเวลา)</section>";
			while($exp = mysqli_fetch_array($r)) {
				if(!empty($exp['position'])) {
					if(is_numeric($exp['period'])) {
						$exp['period'] .= " ปี";
					}
					echo '<div class="position"><span>ต.น</span>'.$exp['position'].'</div>
				 			<div class="workplace"><span>ที่</span>'.$exp['workplace'].'</div>
							<div class="period"><span>นาน</span>'.$exp['period'].'</div>
							<br>';
				}
			} 
			echo "<br>";
		} 

		$sql = "SELECT * FROM education WHERE resume_id = $rid AND LENGTH(level) > 0 ORDER BY edu_id ASC";
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) > 0) {
			echo  "<section>ประวัติการศึกษา (ระดับการศึกษา-สาขาวิชา-สถาบัน)</section>";
			while($edu = mysqli_fetch_array($r)) {
				if(!empty($edu['level'])) {
					echo '<div class="level"><span>ระดับ</span>'.$edu['level'].'</div>
				 			<div class="major"><span>สาขา</span>'.$edu['major'].'</div>
							<div class="academy"><span>สถาบัน</span>'.$edu['academy'].'</div>
							<br>';
				}
			} 
			echo "<br>";
		}
?>

    <section>ความสามารถด้านต่างๆ</section>
    <div class="lang"><span>ภาษาที่รู้</span><?php echo $resume['lang']; ?></div>
    <div class="drive"><span>ขับรถ</span><?php echo ($resume['driving']=="yes")?"ได้":"ไม่ได้"; ?></div>
    <div class="drive"><span>ใบขับขี่</span><?php echo ($resume['driving_license']=="yes")?"มี":"ไม่มี"; ?></div>
    <div class="drive"><span>รถยนต์</span><?php echo ($resume['own_car']=="yes")?"มี":"ไม่มี"; ?></div>
    <br>
    <div class="full"><span>คอมพิวเตอร์</span><?php echo $resume['computing']; ?></div>
    <br>
<?php
 	if(!empty($resume['other_skill'])) {
		echo '<div class="full"><span>ความสามารถอื่นๆ</span>'.$resume['other_skill'].'</div>';
	}
	
	mysqli_close($link);
?>
</article>
</body>
</html>