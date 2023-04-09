<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Online Store</title>
<style>
	body {
		margin: 0px;
		background: url(images/bg.jpg) fixed;
	}
	body > * {
		font-family: tahoma;
	}
	#fixed-container {
		position: fixed;
		width: 100%;
		height: 80px;
		z-index: 1000;
	}
	table {
		margin: auto;
		border-collapse: collapse;
		min-width: 1000px;
	}
	#table-top {
		margin: auto;
		background: powderblue;
	}
	#table-top td {
		border-bottom: solid 1px gray;
	}
	#table-bottom {
		position: relative;
		top: 60px;
		margin-bottom: 30px;
	}
	#table-bottom td {
		padding-top: 2px;
	}
	td {
		vertical-align: top;
		border: solid 1px gray;
	}
	#table-top tr {
		border-left: solid 1px powderblue;
		border-right: solid 1px powderblue;
	}
	#td-logo, #td-aside-left, #td-cart, #td-aside-right {
		width: 150px;
	}
	#td-logo {
		/* background: url(images/logo.gif) center center no-repeat; */
		border-left: solid 1px gray;
	}
	#td-toolbar, #td-content {
		width: 650px;
	}
	#td-cart {
		text-align: center;
		vertical-align: top;
		font-size: 16px;
		color: brown;
		padding-top: 5px;
		border-bottom: solid 1px gray;
		border-right: solid 1px gray;
	}
	#td-aside-left {
		background: #555;
		border-left: solid 1px gray;
	}
	#td-content { 
		text-align: center;
		background: white;
	}
	#td-aside-right {
		background: lavender;
		border-right: solid 1px gray;
	}
	#td-footer {
		border-top: solid 1px gray;
		padding: 5px;
		text-align: center;
		color: navy;
		font-size: 12px;
	}
</style>
</head>

<body>
<div id="fixed-container">
<table id="table-top">
<tr>
<td id="td-logo">&nbsp;<br><br><br></td>
<td id="td-toolbar">&nbsp;</td>
<td id="td-cart">&nbsp;</td>
</tr>
</table>
</div>
<br>
<table id="table-bottom">
<tr>
<td id="td-aside-left">&nbsp;<br><br<</td>
<td id="td-content">&nbsp;<br><br><br><br></td>
<td id="td-aside-right">&nbsp;<br><br></td>
</tr>
<tr>
<td colspan="3" id="td-footer">&nbsp;<br></td>
</tr>
</table>
</body>
</html>