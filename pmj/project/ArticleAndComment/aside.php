<aside>
<form id="member" action="login.php" method="post">
<?php
if(isset($_SESSION['admin'])) {
?>
	<b>สำหรับผู้ดูแลระบบ</b><br>
	&raquo; <a href="new-article.php">เพิ่มบทความใหม่</a> <br> 
    &raquo; <a href="javascript:alert('นำไปทดลองทำเอง')">รายการแจ้งลบ</a> <br>
    &raquo; <a href="logout.php">ออกจากระบบ</a>
<?php
}
else if(isset($_SESSION['member'])) {
	//กรณีที่เป็นสมาชิกและเข้าสู่ระบบแล้ว ...
}
else {
?>
	<b>สมาชิกเข้าสู่ระบบ</b><br>
	<input type="text" name="login" size="18" placeholder="Login"> <a href="new-member.php">สมัครสมาชิก</a><br>
    <input type="password" name="pswd" size="18" placeholder="Password"> <a href="#">ลืมรหัสผ่าน</a><br>
    <button type="submit">เข้าสู่ระบบ</button>
    <input type="checkbox" name="save">เก็บข้อมูลการล็อกอิน<br>
<?php
}
?>
</form>
<br>
<span id="popular">บทความที่มีผู้อ่านมากที่สุด</span><br>
<?php  
	include_once "dblink.php";
	
	$sql = "SELECT * FROM article ORDER BY views DESC, article_id DESC LIMIT 5";
	$r = mysqli_query($link, $sql);
	echo '<ul>';
	while($a = mysqli_fetch_array($r)) {
		$t = mb_substr($a['topic'], 0, 30, 'utf-8') . "...";
		echo '<li><a href="view-article.php?id='. $a['article_id']. '">'.$t.'</a></li>';
	}
	echo '</ul>';
?>
</aside>