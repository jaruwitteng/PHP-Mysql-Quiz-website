<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 16-x</title>
</head>

<body>
<?php
ini_set("SMTP", "smtp.totisp.net");

include ("../../../lib/thaimailer.php");
//include ("../../../lib/ThaiMailer_.php");
$name = "บัญชา"; //"=?utf-8?B?".base64_encode("บัญชา")."?=";

mail_from("$name<webmaster@developerthai.com>");
mail_to("บัญชา<banchar_pa@yahoo.com>,บัญชา<banchar_pa@hotmail.com>,บัญชา<banchar.pa@gmail.com>"); 
//mail_cc("$name<banchar_pa@hotmail.com>");
//mail_bcc("$name<banchar.pa@gmail.com>");
mail_subject("สวัสดีค่ะ");
$b = 'ยืนยันการสมัครเป็นสมาชิก <a href="http://www.developerthai.com" target="_blank">คลิกที่นี่</a>';
mail_body($b,true);
mail_wordwrap(0);
mail_attach("elephant.png","logo.gif"); 
if(mail_send()) {
	echo "เมลถูกส่งออกไปแล้ว<br>";
}
else {
	echo "การส่งเมลล้มเหลว<br>";
}
?>
</body>
</html>