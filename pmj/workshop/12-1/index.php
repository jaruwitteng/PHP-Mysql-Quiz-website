<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 12-1</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		margin: 0px;
		min-width: 700px;
		text-align: center;
	}
	header {
		width: 100%;
		position: fixed;
		top: 0px;
		left: 0px;
		background: #333;
		height: 60px;
		z-index: 10000;
	}
	div#top, div#content {
		width: 600px;
		margin: auto;
	}
	article {
		position: relative;
		top: 60px;
		margin: auto;
		width: 600px;
		text-align: left !important;
		padding-top: 20px;
	}
	form {
		float: left;
		text-align: right;
		margin-top: 15px;
	}
	header  h3 {
		float: left;
		font: normal 36px tahoma;
		color: aqua;
		margin: 5px 20px 5px;
	}
	[type=text]  {
		width: 150px;
		background: #ffc;
		border: solid 1px aqua;
		border-right: none !important; 
		border-radius: 4px 0px 0px 4px; 
		margin-right: -3px;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px aqua;
		border-left: none !important; 
		border-radius: 0px 4px 4px 0px; 
		font-weight: bold;
		margin-left: -3px; 
		height: 28px;
	}
	button:hover {
		color: aqua;
	}
	a:hover {
		color: red;
	}
	br.clear {
		clear: right;
	}
	p#pagenum {
		text-align: center;
		margin: 10px;
	}
	b {
		color: tomato;
		font-weight: bold;
	}
	span.desc {
		display: block;
		margin: 5px 0px;
	}
	span.url {
		color: green;
	}
	span#result {
		float: right;
	}
</style>
</head>

<body>
<header>
<div id="top">
	<h3>DeveloperThai.com</h3>
    <form method="get">
		<input type="text" name="q" maxlength="30" value="<?php echo stripslashes($_GET['q']); ?>" required>
        <button>ค้นหา</button>
 	</form>
</div>
</header>
<article>
<div id="content">
<?php
if($_GET['q']) {
	include "pagination.php";
	
	$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 				or die(mysqli_connect_error()."</body></html>");
	
	$q =  trim($_GET['q']);
	$pat = "/[ ]{1,}/";
	$w = preg_split($pat, $q);
	
	//(title LIKE '%a%') OR (title LIKE '%b%) OR (title LIKE '%c%')
	$title = array();
	foreach($w as $k) {
		$x = "(title LIKE '%$k%')";  //เติมคำแทรกระหว่าง %...%
		array_push($title, $x);
	}
	$title = implode(" OR ", $title);
	
	//(content LIKE '%a%') OR (content LIKE '%b%) OR (content LIKE '%c%')
	$content = array();
	foreach($w as $k) {
		$x = "(content LIKE '%$k%')";  //เติมคำแทรกระหว่าง %...%
		array_push($content, $x);
	}
	$content = implode(" OR ", $content);   
	
	$condition = "$title OR $content";  //(title LIKE '%a%') ... OR (content LIKE '%b%) ...
	
	$sql = "SELECT * FROM sitesearch WHERE $condition";		//echo $sql;
	$rs = page_query($link, $sql, 5);
	
	echo "ค้นหา: " . stripslashes($_GET['q']);
	
	$first = page_start_row();
	$last = page_stop_row();
	$total = page_total_rows();
	if($total == 0) {
		$first = 0;
	}
 	echo "<span id=\"result\">ผลลัพธ์ที่: $first - $last จากทั้งหมด $total </span><br><br>"; 
	
	//ต่อไปเป็นขั้นตอนการทำให้คีย์เวิร์ดเป็นตัวหนา ใช้หลักการตามที่เราเคยทำในบทที่ 7
	//ขั้นแรกนำคีย์เวิร์ดแต่ละคำมาเชื่อมโยงด้วย "|" เพื่อให้แต่ละคำคือ 1 แพตเทิร์น (a|b|c)
	$p = implode("|", $w);
	$p = "/$p/i";
	while($data = mysqli_fetch_array($rs)) {
		//เปลี่ยนคีย์เวิร์ดแต่ละคำใน title และ content ให้เป็นตัวหนา
		$title = htmlspecialchars($data['title']);
		$cont = htmlspecialchars($data['content']);
		$title = preg_replace($p, "<b>\\0</b>", $title);
		$cont = preg_replace($p, "<b>\\0</b>", $cont);
		
		//แสดงผลการสืบค้น
		echo "<a href=\"{$data['url']}\" target=\"_blank\">$title</a>";
		echo "<span class=\"desc\">$cont</span>";
		echo "<span class=\"url\">{$data['url']}</span><br><br>";
	}
	
	//ต่อไปให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ 
	if(page_total() > 1) { 	
		echo '<p id="pagenum">';
		page_echo_pagenums();
		echo '</p>';
	  }
	mysqli_close($link);
}
else {
	echo '<h3>ค้นหาข้อมูลด้วยคีย์เวิร์ด php, mysql, jquery, ajax, dreamweaver, html5, css3</h3>';
}
?>
</div>
</article>
</body>
</html>