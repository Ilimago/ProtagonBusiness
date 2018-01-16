<?php
	require_once '../model/mdb.class.php';

	if(isset($_REQUEST['~table']) && !empty($_REQUEST['~table']))
	{
		$mdb = new mdb($_REQUEST['~table']);
		if(count($_REQUEST['campo']) != 0 | count($_REQUEST['img']) != 0) // Se efectua la insercion
		{
			if($_REQUEST['~action'] == 'insert') // Insertar el registro
			{ 
				// Guardamos tambien las imagenes  
				$_DATA = $_REQUEST['campo'];				

				// Load imagenes
				if(isset($_REQUEST['img']))
				{	
					// print_r($_REQUEST['img']);
					foreach ($_REQUEST['img'] as $key => $value) 
					{
						$_image = subeImagen('../files/img',$value);
						if($_image != false)
						{
							$_DATA[$key] = sprintf('%s',$_image['nombre']);	
						}
					}		
				}
				
				// Load PDF
				if(isset($_REQUEST['pdf']))
				{	
					// print_r($_REQUEST['img']);
					foreach ($_REQUEST['pdf'] as $key => $value) 
					{
						$_file = subePDF('../files/pdf',$value);
						if($_file != false)
						{
							$_DATA[$key] = sprintf('%s',$_file['nombre']);	
						}
					}		
				}				

				if($mdb->insert($_DATA))
				{
					$_return['success'] = true;
					$_return['msg'] = msg(300);
				}
				else
				{
					$_return['success'] = false;
					$_return['msg'] = error(404);
				}
			
			}
			else
			{
				if($_REQUEST['~action'] == 'update') // Actualizamos el registro
				{
					$paramId = sprintf('%d', $_REQUEST['~id']);
					if($_REQUEST['~id'] != 0) // Se reliza la actualizacion
					{
						if($_REQUEST['~where'] != '') // Se reliza la actualizacion
						{
							$_DATA = $_REQUEST['campo'];				

							if(isset($_REQUEST['img']))
							{	
								// print_r($_REQUEST['img']);
								foreach ($_REQUEST['img'] as $key => $value) 
								{
									$_image = subeImagen('../files/img',$value);
									if($_image != false)
									{
										$_DATA[$key] = sprintf('%s',$_image['nombre']);	
									}
								}		
							}
							
							// Load PDF
							if(isset($_REQUEST['pdf']))
							{	
								// print_r($_REQUEST['img']);
								foreach ($_REQUEST['pdf'] as $key => $value) 
								{
									$_file = subePDF('../files/pdf',$value);
									if($_file != false)
									{
										$_DATA[$key] = sprintf('%s',$_file['nombre']);	
									}
								}		
							}

							if($mdb->update($_DATA, ($_REQUEST['~where'] . "='" .  $_REQUEST['~id'] . "'")))
							{
								$_return['success'] = true;
								$_return['msg'] = msg(301);
							}
							else
							{
								$_return['success'] = false;
								$_return['msg'] = error(404);
							}						
						}
						else
						{
							$_return['success'] = false;
							$_return['msg'] = error(405);
						}
					}
					else // Se deniega la actualizacion
					{
						$_return['success'] = false;
						$_return['msg'] = error(402);
					}
				}
				else
				{
					$_return['success'] = false;
					$_return['msg'] = error(403);
				}
			}
		}
		else // Se deniega la insercion
		{ 
			$_return['success'] = false;
			$_return['msg'] = error(401);
		}
	}
	else
	{
		$_return['success'] = false;
		$_return['msg'] = error(400);
	}

	// if(isset($_REQUEST['~test']) && $_REQUEST['~test'] == true)
	// {
	// 	echo '<pre>'>;
	// 	print_r($_REQUEST);
	// 	echo '</pre>'>;
	// }

	echo json_encode($_return);

	function error($c){
		switch ($c) {
			case 400: $msg = 'frmError #'. $c .': No se ha especificado el parametro ~table.'; break;
			case 401: $msg = 'frmError #'. $c .': La matriz de campos a guardar no puede estar vacio.'; break;
			case 402: $msg = 'frmError #'. $c .': El parametro [~id] no puede ser 0 para editar.'; break;
			case 403: $msg = 'frmError #'. $c .': No se ha especificaco un action [~action].'; break;
			case 404: $msg = 'frmError #'. $c .': Ocurrio un error en Base de Datos.'; break;
			case 405: $msg = 'frmError #'. $c .': No se ha especificado sobre que campo editar.'; break;
			case 406: $msg = 'frmError #'. $c .': No se ha subido la imagen.'; break;
			default: $msg = 'Undefined'; break;
		}

		return $msg;
	}

	function msg($m){
		switch ($m) {
			case 300: $msg = 'Se guardo correctamente en la Base de Datos.'; break;
			case 301: $msg = 'Se Actualizo correctamente en la Base de Datos.'; break;
			default: $msg = 'Undefined'; break;
		}

		return $msg;
	}

	function subeImagen($destino,$elm= 'file'){
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<12;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		$tamano = $_FILES [$elm]['size']; 
		
		$tamaño_max = "500000000000"; 
		 
		if( $tamano < $tamaño_max){ 		 
			$sep  = explode('image/',$_FILES[$elm]["type"]);
			$tipo = $sep[1]; 
			if($tipo == '')
				{ return false; }
			else{
				if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp" || $tipo =='jpeg'|| $tipo =='jpg'|| $tipo =='png'|| $tipo =='PNG'){ 
					$_archivo['blob'] = 'data:'.$_FILES[$elm]['type'].';base64,' . base64_encode($datos);//data:image/jpeg;base64,
					$_archivo['mini'] = 'data:'.$_FILES[$elm]['type'].';base64,' . base64_encode($miniatura);
					$_archivo['nombre'] = $cad.'.'.$tipo;
					$_archivo['tipo'] = $_FILES[$elm]['type'];
					$_archivo['peso'] = $_FILES[$elm]['size'];
					
					$des=$destino . '/' .$cad.'.'.$tipo;
					copy($_FILES[$elm]['tmp_name'],$des);
					
					return $_archivo;  
				}
				else return false;  
			}
		}
		else return false;  
	} 

	function subePDF($destino,$elm= 'file'){
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<12;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		$tamano = $_FILES [$elm]['size']; 	
		$tamaño_max = "500000000000"; 
			
		if( $tamano < $tamaño_max){ 
			$sep  = explode('application/',$_FILES[$elm]["type"]);
			$tipo = $sep[1]; 
			if($tipo == '')
				{ return false; echo ' | Test : 3';}
			else{
				if($tipo == "pdf" || $tipo == "PDF" ){ 				
					$_archivo['nombre'] = $cad . '.' . $tipo;
					$_archivo['tipo'] = $_FILES[$elm]['type'];
					$_archivo['peso'] = $_FILES[$elm]['size'];
					
					$des=$destino . '/' .$cad.'.'.$tipo;
					copy($_FILES[$elm]['tmp_name'],$des);
					return $_archivo; 
				}
				else return false;
			}
		}
		else return false;
	} 
?>