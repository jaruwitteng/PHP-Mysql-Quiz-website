<?php  ob_start();  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 15-1</title>
<style>
	* {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
		text-align: center;
	}
	form {
		display: inline-block;
		margin: 20px auto;
		text-align: left;
	}
	[type=text]  {
		width: 200px;
		background: #ffc;
		border: solid 1px gray;
		border-right: none !important; 
		border-radius: 4px 0px 0px 4px; 
		margin-right: -3px;
		padding-left: 3px;
		padding-right: 5px;
		height: 24px;
		margin-bottom: 5px;
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
</style>
</head>

<body>
<?php
if($_POST['q']) {
	if($_POST['search'] == "google") {
		$google = "http://www.google.com/search?q=";
		$q = urlencode($_POST['q']);
		$google .= $q;
		
		header("location: $google");
		exit('</body></html>');
		ob_end_flush();
	}
}
?>
<form method="post" target="_blank">
	<input type="text" name="q" maxlength="30" required> 
    <button>Search</button><br>
    <input type="radio" name="search" value="google" checked>Google
    <input type="radio" name="search" value="site">This Site  
    
</form>
</body>
</html>
<?php  ob_end_flush();  ?>