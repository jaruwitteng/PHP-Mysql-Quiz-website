<?php  
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Jobs Online</title>
<style>
	@import "global.css";
	section#content {
		padding: 5px 0px 10px 10px !important;
	}
	section#content div {
		display: inline-block;
	}
	div.job {
		width: 720px;
		background: #eef;
		border-bottom: dotted 1px gray;	
		padding: 3px 5px;
		border-radius: 4px;
		margin-top: 5px;
	}
	div.position {
		width: 550px;	
		font-size: 18px;
		color: brown;	
	}
	div.quantity {
		width: 160px;
		border: solid 0px;
		text-align: right;
	}
	div.desc   {
		color: green;
		padding: 3px 0px 0px 15px;
	}
	div.qual {
		width: 700px;
		padding-left: 10px;
		padding-top: 10px;	
	}
	ul {
		margin-top: 0px;
	}
	div.qual a {
		display: inline-block;
		border: solid 1px gray;
		padding: 2px 10px;
		margin: -20px 0px 10px 10px;
		text-decoration: none;
		background: orange;
		color: white;
		border-radius: 5px;
		font-size: 13px;
		cursor: default;
	}
	div.qual a:hover {
		background: #ffc;
		color: red;
	}
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
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
		<h3>ตำแหน่งงาน</h3>
        <div>บริษัท PHP จำกัด(มหาชน) ต้องการเพื่อนร่วมงาน ที่ต้องการเติบโตไปกับเรา ในตำแหน่งต่างๆดังต่อไปนี้</div>
	</section>
	<section id="content">
<?php
	include "dblink.php";
	include "lib/pagination.php";
	
	$sql = "SELECT * FROM jobs ORDER BY date_post DESC";
	$r1 = page_query($link, $sql, 5);
	while($job = mysqli_fetch_array($r1)) {
		$j =  $job['position'];
		$q = $job['quantity'];
		if(is_numeric($q)) {
			$q =  $job['quantity'] . " อัตรา";
		}
		
		echo "<div class=\"job\">
					<div class=\"position\">$j</div>
					<div class=\"quantity\">$q</div>
				</div><br>";
				
		if(!empty($job['description'])) {
			echo "<div class=\"desc\">{$job['description']}</div><br>";
		}
		$jid = $job['job_id'];
		$sql = "SELECT * FROM qualification WHERE job_id = $jid ORDER BY qual_id ASC";
		$r2 = mysqli_query($link, $sql);
		echo "<div class=\"qual\"><ul>";
		while($qual = mysqli_fetch_array($r2)) {
			if(!empty($qual['qual_text'])) {
				echo "<li>{$qual['qual_text']}</li>";
			}
		}
		echo "</ul>";
		if(isset($_SESSION['user'])) {
			echo "<a href=#>ลบ</a><a href=#>แก้ไข</a>";
		}
		echo "</div><br>";
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
<?php include "footer.php";  ?>
</div>
</body>
</html>