	<span>DataLeague Project - &copy;<?php echo date('Y'); ?> - All Rights Reserved</span>
    <?php
	if(!isset($_SESSION['admin'])) {
		echo '&nbsp;&nbsp;&nbsp;&nbsp;
    			[<a href="login.php">Administrator Login</a>]';
	}
	else {
		echo '&nbsp;&nbsp;&nbsp;&nbsp;
				[<a href="update-match.php">Update Data</a>]
    			[<a href="logout.php">Logout</a>]';
	}
	?>