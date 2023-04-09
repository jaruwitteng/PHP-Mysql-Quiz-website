<?php
session_start();
include "dblink.php";
include "datetime-ago.php";  //รายละเอียดอยู่ในบทที่ 5

//เลือกเอา 5 ข้อความล่าสุด
$sql = "SELECT * FROM chitchat ORDER BY date_post DESC LIMIT 5";
$rs = mysqli_query($link, $sql);
$row = mysqli_num_rows($rs) - 1;

//ข้อความที่อ่านได้จากตารางจะเรียงจากล่าไปสุดไปยังหลังสุด
//การแสดงผล เราต้องเรียงจากความหลังสุดไปยังข้อความล่าสุด(จากบนลงล่าง)
//ดังนั้นจึงต้องลูป for อ่านข้อความแบบย้อนกลับจากหลังสุดไปยังล่าสุด
for($i = $row; $i >= 0; $i--) {
	mysqli_data_seek($rs, $i);
	$data = mysqli_fetch_array($rs);
	$ago = datetime_ago($data['date_post']);
?>
<div class="chat-msg">
	<img src="profile.png" class="chat-profile">
	<div class="chat-aside-img">
    	<div class="chat-name-time">
			<span class="chat-name"><?php echo $data['name']; ?></span>
        	<span class="chat-time"><?php echo $ago; ?></span>
        </div>
		<span class="chat-text"><?php echo $data['message']; ?></span>
	</div><br class="clear-both">
</div>
<?php
}
mysqli_close($link);
?>