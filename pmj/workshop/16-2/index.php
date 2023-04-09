<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 16-2</title>
<style>
	@import "style.css";
	form {
		display: inline-block;
		margin: auto;
		border: solid 1px gray;
		padding: 20px;
		background: powderblue;
		text-align: left !important;
		border-radius: 5px;
	}
	form > span {
		display: block;
		padding: 5px 0px;
		background: #69c;
		width: 100%;
	}
	[type=email]  {
		width: 300px;
		background: white;
		border: solid 1px  gray;
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
		border: solid 1px gray;
		border-left: none !important; 
		border-radius: 0px 4px 4px 0px; 
		font-weight: bold;
		margin-left: -3px; 
		height: 28px;
	}
	button:hover {
		color: aqua;
	}
	[type=radio] {
		margin: 10px 5px;
	}
	.err {
		color: red;
	}
</style>
</head>

<body>
<header>
<div id="top">
 		<h3>The PHP Company Newsletter</h3>
        <nav>
			<a href="index.php">Subscribe</a>
			<a href="send-news.php">Send News</a>
		</nav>
</div>
<div id="breadcrumb">
	<section><img src="contacts.png">Subscribe</section>
</div>
</header>
<article>
<div id="content">
<?php
if($_POST) {
	$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 			or die(mysqli_connect_error()."</div></article></body></html>");
			
	$email = $_POST['email'];
	$class = ' class="err"';
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$msg = "รูปแบบของอีเมลไม่ถูกต้อง";
	}
	else {
		if($_POST['subscribe']=="subscribe") {
			$sql = "SELECT COUNT(*) FROM newsletter WHERE email = '$email'";
			$rs = mysqli_query($link, $sql);
			$data = mysqli_fetch_array($rs);
			if($data[0] != 0) {
				$msg = "อีเมลนี้ เป็นสมาชิกอยู่แล้ว";
			}
			else {
				$sql = "INSERT INTO newsletter VALUES('$email', CURRENT_DATE())";
				mysqli_query($link, $sql);
				$msg = "สมัครรับข่าวสารเสร็จเรียบร้อย";
				$class = "";
			}
		}
		else if($_POST['subscribe']=="unsubscribe") {
			$sql = "DELETE FROM newsletter WHERE email = '$email'";
			mysqli_query($link, $sql);
		}
	}
	echo "<h3$class>$msg</h3>";
	mysqli_close($link);
}
?>
	<form method="post">
		<input type="email" name="email" placeholder="อีเมลของท่าน ที่จะใช้รับจดหมายข่าว" required>
        <button>ส่งข้อมูล</button><br>
        <input type="radio" name="subscribe" value="subscribe" checked>สมัครรับข่าวสารทางอีเมล
        <input type="radio" name="subscribe" value="unsubscribe">ยกเลิกรับข่าวสาร
    </form>
</div>
</article>
<br><br>
</body>
</html>