<?php include 'config.php';
	session_start();
	if( !$_SESSION['login'] ){
	 	echo '<script type="text/javascript"> location.href = "../../"; </script>';
	}
?>
