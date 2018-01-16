<?php
	session_start();
	echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';

	// unset($_SESSION['sm']);
	// unset($_SESSION['cli_login']);
?>