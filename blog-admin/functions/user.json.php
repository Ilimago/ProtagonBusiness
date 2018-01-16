<?php
	session_start();
	$data['info']['name'] 		= "blog-admin";
	$data['info']['version'] 	= "V3.1.0";
	$data['info']['empresa'] 	= "Ilimago";
	$data['info']['fecha'] 		= "Julio 2016";

	$data['success'] 	= $_SESSION['login'];
	$data['userName'] 	= $_SESSION['user_full'];
	$data['userMail'] 	= $_SESSION['mail'];
	$data['sexo'] 		= $_SESSION['sexo'];
	$data['caduca'] 	= $_SESSION['usu_caduca'];
	$data['foto'] 		= $_SESSION['foto'];
	$data['perfil'] 	= $_SESSION['perfil'];

	echo json_encode($data);
?>