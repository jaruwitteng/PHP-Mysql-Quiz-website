<?php
$link_uol = @mysqli_connect("localhost", "root", "abc456")
 				or die(mysqli_connect_error());

//ถ้ายังไม่มีฐานข้อมูลให้สร้างขึ้นมาใหม่
$sql = "CREATE DATABASE IF NOT EXISTS pmj";
@mysqli_query($link_uol, $sql);
@mysqli_select_db($link_uol, "pmj");

//ถ้ายังไม่มีตารางให้สร้างขึ้นใหม่
$sql = "CREATE TABLE IF NOT EXISTS useronline(
			sid  VARCHAR(32) UNIQUE,
			expire DATETIME)";
			
@mysqli_query($link_uol, $sql);

$sid = session_id();

//ควรเริ่มต้นด้วยการลบ SID  ที่หมดอายุแล้วทิ้งไปก่อน
$sql = "DELETE FROM useronline WHERE  expire < NOW()";
@mysqli_query($link_uol, $sql);

//ในการบันทึกค่า  SID   ในที่นี้เลือกใช้คำสั่ง REPLACE 
//เนื่องจาก หากยังไม่มีค่า  SID   อยู่ก่อนจะเพิ่มข้อมูลลงไปเหมือนคำสั่ง  INSERT
//แต่หากมี  SID  อยู่ก่อนแล้ว ก็จะเป็นการแก้ไขข้อมูลเดิมเหมือนคำสั่ง UPDATE
$sql = "REPLACE INTO useronline VALUES
 			('$sid', DATE_ADD(NOW(), INTERVAL 15 MINUTE))";
			
@mysqli_query($link_uol, $sql);

//เนื่องจากเราได้ลบ sid ที่หมดอายุออกไปแล้ว จึงสามารถนับได้โดยไม่จำเป็นต้องมีเงื่อนไขการนับ
$sql = "SELECT COUNT(*)  FROM  useronline";
$result = mysqli_query($link_uol, $sql);
$data = mysqli_fetch_array($result);
$num_users = $data[0];
echo number_format($num_users);
@mysqli_close($link_uol);
?>