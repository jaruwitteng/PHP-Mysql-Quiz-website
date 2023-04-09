<a href="#"><img src="images/football.png">หน้าแรก</a>
<?php 
include_once "leagues.php";
for($i=0; $i < count($leagues); $i++) {
	//$leagues[$i][0] = code
	//$leagues[$i][1] = league
	//$leagues[$i][2] = image
	$href = "index.php?league={$leagues[$i][0]}";
	echo "<a href=\"$href\"><img src=\"{$leagues[$i][2]}\">{$leagues[$i][1]}</a>";
}
?>
<br>