<?php
	require_once '../../functions/conexion.class.php';
	require_once '../model/usuario.class.php';
	$mdb = new usuario();
	
	$imgn = $mdb->getUser( sprintf('%d', $_POST['usuario']) );
	if (!empty($imgn[0]['usu_foto'])) {
		$dir="../../files/user/".$imgn[0]['usu_foto'];
		unlink($dir);
	}

	$data = $mdb->delete( sprintf('%d', $_POST['usuario']) );
	$_result['success'] = $data;
	echo json_encode( $_result );
?>