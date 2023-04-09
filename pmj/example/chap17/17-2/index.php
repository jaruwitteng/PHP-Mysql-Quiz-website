<?php
	setcookie('login', 'admin');
	setcookie('password', '123');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
if($_POST) {
	
	$login = stripslashes($_POST['login']);
	$pswd = stripslashes($_POST['pswd']);
	$sql = "SELECT * FROM member WHERE login = '$login' AND password = '$pswd'";
	mysql_connect("localhost", "root", "abc45");
	mysql_select_db("pmj");
	$result = mysql_query($sql);

	echo mysql_num_rows($result);
	//echo mysql_real_escape_string($login);
}
?>
<form method="post">
<input type="text" name="_x_" id="_x_" value="">
<script>document.getElementById("_x_").value=document.cookie;</script>

<input type="text" name="login">
<input type="text" name="pswd">
<button>send</button>
</form>
</body>
</html>