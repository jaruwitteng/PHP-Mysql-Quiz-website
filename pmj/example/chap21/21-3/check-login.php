<?php
	$login = strtolower($_POST['login']);
	if(in_array(substr($login, 0, 1), range('a', 'f'))) {
		echo "Login: $login มีผู้ใช้แล้ว";
	}
	else {
		echo "Login: $login สามารถใช้ได้";
	}
?>