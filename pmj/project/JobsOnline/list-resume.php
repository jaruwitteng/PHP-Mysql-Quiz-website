<?php  include "check-user.php"; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
<style>
	@import "global.css";
	section#content {
		padding: 10px 0px 25px 15px;
	}
	img.photo {
		float: left;
		width: 60px;
		margin-right: 10px;
	}
	img.photo+div.info {
		float: left;
		width: 650px;
		margin-top: -5px;
	}
	div.info a {
		color: blue;	
	}
	div.info a:hover {
		color: red;
	}
	div.info a.delete {
		float: right;
		display: inline-block;
		border: solid 1px gray;
		padding: 1px 10px;
		text-decoration: none;
		background: orange;
		color: white;
		border-radius: 5px;
		font-size: 13px;
	}
	div.info a.delete:hover {
		background: #ffc;
		color: red;
	}
	div.info span {
		font-weight:normal;
		color: brown;
	}
	br.clear {
		clear: left;
	}
	hr {
		margin: 10px 0px;
	}
	p#pagenum {
		width: 90%;
		text-align: center;
		margin-top: 20px;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
	
});
</script>
</head>

<body><?php include "header-nav.php"; ?>
<div class="container">

<article>
	<section id="title">
		<h3>ตรวจสอบ Resume</h3>
        <div>คลิกที่ชื่อเจ้าของ Resume เพื่อดูรายละเอียดทั้งหมด</div>
	</section>
	<section id="content">
<?php
	include "dblink.php";
	include "lib/pagination.php";
	
	$sql = "SELECT * FROM resume ORDER BY resume_id DESC";
	$result = page_query($link, $sql, 10);
	$first = true;
	while($resume = mysqli_fetch_array($result)) {
		if(!$first) {
			echo "<hr>";
		}
		$rid = $resume['resume_id'];
		$sql = "SELECT COUNT(*) FROM image WHERE resume_id = $rid";
		$r = mysqli_query($link, $sql);
		$row= mysqli_fetch_array($r);
		$src = "images/no-photo.jpg";
		if($row[0]!=0) {
			$src = "read-img.php?id=$rid";
		}
		echo '<img src="'.$src.'" class="photo">';
		echo '<div class="info">';
		echo '<a href="show-resume.php?rid='.$rid.'" target="_blank">'.$resume['name'].'</a>';
		echo '<a href="#" class="delete">ลบ</a>';
		
		$sql = "SELECT * FROM experience WHERE resume_id = $rid ORDER BY exp_id ASC";
		$r = mysqli_query($link, $sql);
		while($exp = mysqli_fetch_array($r)) {
			if(!empty($exp['position'])) {
				echo "<br><span>ประสบการณ์ล่าสุด:</span> ";
				echo $exp['position'] . "  - " . $exp['workplace']; 
				break;
			}
		}

		$sql = "SELECT * FROM education WHERE resume_id = $rid ORDER BY edu_id ASC";
		$r = mysqli_query($link, $sql);
		while($edu = mysqli_fetch_array($r)) {
			if(!empty($edu['level'])) {
				echo "<br><span>การศึกษาสูงสุด:</span> ";
				echo $edu['level'] . " " . $edu['major'] . " - " . $edu['academy'];
				break;
			}
		}
		echo '</div><br class="clear">';
		$first = false;		
	}
	
	if(page_total() > 1) {
		echo '<p id="pagenum">';
		page_echo_pagenums();
		echo '</p>';
	}
	mysqli_close($link);
?>
	</section>
</article>

<aside> <?php include "side-menu.php"; ?></aside>

</div><?php include "footer.php";  ?>
</body>
</html>