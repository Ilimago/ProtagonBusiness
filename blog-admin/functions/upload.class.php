<?php
	class fileUpload{
		function fileUpload(){}

		function Imagen( $destino, $elm= 'file' ){
			$cad = $this->nuevoNombre();
			$tamano = $_FILES [$elm]['size']; 			
			$tamaño_max = "500000000000"; 
			 
			if( $tamano < $tamaño_max){ 		 
				$sep  = explode('image/',$_FILES[$elm]["type"]);
				$tipo = $sep[1]; 
				if($tipo == '')
					{ return false; }
				else{
					if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp" || $tipo =='jpeg'|| $tipo =='jpg'|| $tipo =='png'|| $tipo =='PNG'|| $tipo =='JPG'|| $tipo =='JPEG'){ 

						$_archivo['nombre'] = $cad.'.'.$tipo;
						$_archivo['tipo'] = $_FILES[$elm]['type'];
						$_archivo['peso'] = $_FILES[$elm]['size'];
						
						$des = $destino . '/' .$cad.'.'.$tipo;
						copy($_FILES[$elm]['tmp_name'],$des);
						
						return $_archivo;  
					}
					else return false;  
				}
			}
			else return false;  
		} 

		function PDF( $destino, $elm= 'file' ){
			$cad = $this->nuevoNombre();
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

		function nuevoNombre( $tamano = 12 ){
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$cad = "";
			for( $i=0; $i < $tamano; $i++) {
				$cad .= substr($str,rand(0,62),1);
			}

			return $cad;
		}
	}
	
?>