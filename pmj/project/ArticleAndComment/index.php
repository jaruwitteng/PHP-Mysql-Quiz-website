<?php	session_start();  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Article & Comment</title>
<style>
	@import "global.css";
	div.img-container {
		float: left;
		margin-right: 10px;
		padding-top: 8px;
		overflow: hidden;
	}
	img.cover {
		max-width: 120px;
	}
	div.article-container {
		float: left;
		width: 500px;
	}
	div.article-container a:hover {
		color: red;
	}
	span.topic {
		font-weight: bold;
		color: brown;
		border-bottom: dotted 1px gray;
	}
	br.clear {
		clear: left;
	}
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
	a.readmore {
		color: blue;
		text-decoration: none;
	}
	a.readmore:hover {
		color: red;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {

});
</script>
</head>
<body>
<?php  include "header-nav.php"; ?>

<div id="container">
<?php
include "logo-banner.php"; 
$page_title = "บทความล่าสุด";
include "breadcrumbs.php"; 
?>

<article>
<?php
	include "dblink.php";
	include "lib/pagination.php";
	
	$sql = "SELECT * FROM article ORDER BY article_id DESC";
	$r = page_query($link, $sql, 10);
	while($a = mysqli_fetch_array($r)) {
		$src = "images/cover-image.jpg";  //ภาพดีฟอลต์ กรณีไม่ได้กำหนดรูปภาพเอาไว้
		if($a['image_id'] != 0) {
			$src = "read-image.php?id={$a['image_id']}";
		}
		echo '
			<div class="img-container"><img src="'.$src.'" class="cover"></div>
			<div class="article-container">
		 		<span class="topic">'.$a['topic'] . '</span><br>' .
		 		mb_substr($a['article_text'], 0, 120, 'utf-8') . '...<br>' . ' 
				<a href="view-article.php?id='.$a['article_id'].'" class="readmore">อ่านต่อ &raquo;</a>
		 	</div>
		 	<br class="clear"><br>';
	}
	
	if(page_total() > 1) {
		echo '<p id="pagenum">';
		page_echo_pagenums();
		echo '</p>';
	}
?>
</article>

<?php include "aside.php"; ?>
<?php include "footer.php"; ?>
</div>
</body>
</html>
<?php @mysqli_close($link); ?>