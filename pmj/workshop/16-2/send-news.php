<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Workshop 16-2</title>
<style>
	@import "style.css";
	
	form {
		width: 90%;
		margin: auto;
		border: solid 1px gray;
		background: powderblue;
		text-align: center;
		border-radius: 3px;
		padding-top: 5px
	}
	form > span {
		display: inline-block;
		padding: 3px 0px;
		background: #69c;
		width: 100%;
		margin-top: 5px;
		text-align: left;
		
	}
	form > span > label {
		display: inline-block;
		margin: 2px 10px;
		color: white;
	}
	[type=text], textarea  {
		border: solid 1px gray;
		width: 95%;
		margin: 5px 10px;
		padding: 3px;
		border-radius: 3px;
	}
	textarea {
		height: 100px;
		resize: none;
		overflow: auto;
	}
	[type=checkbox] {
		margin: 8px 5px 0px 10px;
	}
	button {
		background: #f60;
		color: white;
		border: solid 1px silver;
		border-left: none !important; 
		border-radius: 4px; 
		font-weight: bold;
		margin-right: 10px; 
		float: right;
		padding: 3px 10px;
	}
	button:hover {
		color: aqua;
	}
	a:hover {
		color: red;
	}
	iframe {
		border: none;
		width: 90%;
		height: 40px;
		font-size: 14px;
		margin-left: 20px;
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
	<section><img src="news.png"> Send News</section>
</div>
</header>
<article>
<div id="content">
	<form method="post">
    	<input type="text" name="subject" placeholder="หัวข้อข่าวสาร" value="<?php echo stripslashes($_POST['subject']); ?>" required><br>
        <textarea name="body" placeholder="เนื้อหาของข่าว (ใช้แท็ก HTML ได้)"><?php echo stripslashes($_POST['body']); ?></textarea>
     <span>
     <label>
          ส่งครั้งละ  <select name="limit">
     						<option value="10"<?php if($_POST['limit']==10) echo " selected"; ?>>10</option>
                    		<option value="15"<?php if($_POST['limit']==15) echo " selected"; ?>>15</option>
                    		<option value="20"<?php if($_POST['limit']==20) echo " selected"; ?>>20</option>
                 		</select> อีเมล (ให้ส่งซ้ำไปเรื่อยๆ ข่าวจะไม่ถูกส่งซ้ำคนเดิม)
      </label>
     <button>ส่งข่าวสาร</button><br class="clear">
     </span>
    </form>
 <?php
if($_POST) {
	ini_set("SMTP", "smtp.totisp.net");
	include "thaimailer.php";
	$subject = stripslashes($_POST['subject']);
	$body = stripslashes($_POST['body']);
	$limit = $_POST['limit'];
	
	mail_from("info<info@developerthai.com>");
	mail_subject($subject);
	mail_body($body, true);
	
	$link = @mysqli_connect("localhost", "root", "abc456", "pmj")
 				or die(mysqli_connect_error()."</div></article></body></html>");

 	//เลือกอีเมลมาเป็นจำนวนเท่ากับที่เลือกจากฟอร์ม
	$sql = "SELECT email FROM newsletter WHERE last_sent < CURRENT_DATE() LIMIT $limit";
	$rs = mysqli_query($link, $sql);
	//ส่งอีเมลไปยังสมาชิกเหล่านั้น
	$eml = array();
	while($data = mysqli_fetch_array($rs)) {
		$e = "<".$data['email'].">";
		array_push($eml, $e);
	}
	$to = implode(",", $eml);
	mail_to("$to");
	if(mail_send()) {   //ถ้าส่งสำเร็จให้อัปเดตวันที่ส่งข่าวสารล่าสุดเป็นวันที่ปัจจุบัน
		mysqli_data_seek($rs, 0);
		while($data = mysqli_fetch_array($rs)) {
			$e = $data['email'];
			$sql = "UPDATE newsletter SET last_sent = CURRENT_DATE()
			 			WHERE email = '$e'";
			@mysqli_query($link, $sql);
		}
	}
	//ต่อไปเป็นขั้นตอนตรวจสอบว่ามีจำนวนสมาชิกทั้งหมดเท่าไหร่
	$sql = "SELECT COUNT(*) FROM newsletter";
	$rs = @mysqli_query($link, $sql);
	$data = @mysqli_fetch_array($rs);
	$subscribers = $data[0];		
	
	//ยังเหลืออีกกี่คนที่ยังไม่ได้ส่งข่าวสารไปให้
	$sql = "SELECT COUNT(*) FROM newsletter 
	 			WHERE last_sent < CURRENT_DATE()";
				
	$rs = @mysqli_query($link, $sql);
	$data = @mysqli_fetch_array($rs);
	$pending = $data[0];			
 
	echo "<br><b>จำนวนสมาชิกที่ต้องส่งข่าวสาร:</b> " . number_format($subscribers);
	echo "&nbsp;&nbsp;<b>จำนวนค้างส่ง:</b> " . number_format($pending);
	mysqli_close($link);
}
?>
</div>
</article>
<br>
</body>
</html>