<?php
	$id = $_GET['id'];
	$js = "\$('[data-id=$id]').parent().parent().remove();";
	echo $js;
?>