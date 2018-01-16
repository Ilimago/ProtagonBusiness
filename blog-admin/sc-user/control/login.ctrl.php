<?php include '../../functions/languaje.php'; ?>
<?php
	session_start();
	require_once '../model/login.class.php';
	$obj = new login;

	if( empty($_POST['mail']) ){
		$_retur['success'] = false;
		$_retur['msg'] = $GLOBALS[$ln]['login'][5];
	}
	else{
		if($obj->access($_POST['mail'], $_POST['pass'])){
			$_retur['success'] = true;
			$_retur['msg'] = 'Acceso correcto';
		}
		else{
			$_retur['success'] = false;
			$_retur['msg'] = $GLOBALS[$ln]['login'][4];
		}
	}
	
	
	echo json_encode($_retur);

?>