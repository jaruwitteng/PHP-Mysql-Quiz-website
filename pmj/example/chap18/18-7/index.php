<?php
require_once('../../../lib/ThaiPDF/thaipdf.php');
ob_start();
?>

<html>
<head>
<style>
	table { border-collapse: collapse; margin: auto; }
	th { background-color:#cdf; }
	th, td { padding: 4px; width: 150px;  }
	td { vertical-align:top; }
	caption { text-align: center; }
	tr:nth-of-type(odd) { background-color: #ddd; }
</style>
</head>
<body>
<table border="1">
<caption>ข้อมูลบางส่วนของรถรุ่น All New PDF</caption>
<tr>
	<th rowspan="2">ข้อมูล</th>
    <th colspan="3">รุ่น</th>
</tr>
<tr>
	<th>Basic</th>
    <th>Standard</th>
    <th>Premium</th>
</tr>
<tr>
	<td>เครื่องยนต์</td>
    <td>1,795 ซีซี (120 แรงม้า)</td>
    <td>1,995 ซีซี (130 แรงม้า)</td>
    <td>2,195 ซีซี (140 แรงม้า)</td>
 </tr>
 <tr>
	<td>ระบบเกียร์</td>
    <td>ธรรมดา</td>
    <td>อัตโนมัติ</td>
    <td>อัตโนมัติ</td>
 </tr>
  <tr>
	<td>ความปลอดภัย</td>
    <td>ถุงลมนิรภัยด้านคนขับ</td>
    <td>ถุงลมนิรภัยคู่หน้า, เบรค ABS, กุญแจนิรภัย</td>
    <td>ถุงลมนิรภัยคู่หน้า, เบรค ABS, กุญแจนิรภัย, สัญญาณกันขโมย, กล้องมองถอยหลัง</td>
 </tr>
  <tr>
	<td>สีที่มีให้เลือก</td>
    <td>
    <ul>
    	<li>บรอนซ์</li><li>ขาว</li><li>ดำ</li><li>น้ำเงิน</li><li>แดง</li>
    </ul>
        </td>
    <td>
     <ul>
    	<li>บรอนซ์</li><li>ขาว</li><li>ดำ</li><li>น้ำเงิน</li>
    </ul>   
    </td>
    <td>
     <ul>
    	<li>บรอนซ์</li><li>ขาว</li><li>น้ำเงิน</li>
    </ul> 
   </td>
 </tr>
  <tr>
	<td>ราคา</td>
    <td>800,000</td>
    <td>900,000</td>
    <td>1,000,000</td>
 </tr>
</table>
</body>
</html>
<?php
$html = ob_get_clean();
pdf_html($html);
pdf_echo();
?>