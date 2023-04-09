<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example Select</title>
<style>
	* {
		font: 14px tahoma;
	}
</style>
</head>

<body>
<?php
if($_POST['flower']) { 		//
	$f = $_POST['flower'];
	echo "ดอกไม้ที่ท่านชื่นชอบที่สุดคือ: $f";
}
?>
<form method="post">
	<table>
    <tr valign="top"><td>
	Single Selection<br>
	<select name="title">
    	<option>กุหลาบ</option>
        <option>กล้วยไม้</option>
        <option>คาร์เนชั่น</option>
     </select>
     </td>
     <td>&nbsp;</td>
<td>
     Multiple Selection<br>
     <select multiple>
    	<option>กุหลาบ</option>
        <option>กล้วยไม้</option>
        <option>คาร์เนชั่น</option>
        <option>ลิลลี่</option>
     </select>
     </td></tr>
     </table>
</form> 

</body>
</html>