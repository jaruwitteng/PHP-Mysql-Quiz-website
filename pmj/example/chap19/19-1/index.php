<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example 19-1</title>
</head>

<body>
ข้อความนี้เขียนใน HTML โดยตรง
<script>
document.write("<br>");
document.write("ข้อความนี้เขียนด้วย JavaScript");
	
document.write("<hr>");
document.write("<div style='font-weight:bold; color:red;'>" +
 		"เนื้อหาในหนังสือเล่มนี้ประกอบด้วย:</div>");
document.write("<ul>");
document.write("<li>PHP</li>");
document.write("<li>MySQL</li>");
document.write("<li>jQuery</li>");
document.write("</ul>");
var name = prompt("กรุณาใส่ชื่อของท่านด้วยค่ะ");
</script>


</body>
</html>