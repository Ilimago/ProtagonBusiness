<?php 	
	//require 'cms.config.php';
	class DBManager{
		// Datos de conexión de MySQL Server
		var $conect;
		var $BaseDatos;
		var $Servidor;
		var $Usuario;
		var $Clave;
			
		var $conf;
		function DBManager(){
			$this->BaseDatos = "protagon_bloginn";
			$this->Servidor  = "localhost";
			$this->Usuario 	 = "protagon_webmast";
			$this->Clave	 = "Miacceso123*";
		}
        
        /*function DBManager(){
			$this->BaseDatos = "blog_viajes";
			$this->Servidor  = "localhost";
			$this->Usuario 	 = "root";
			$this->Clave	 = "admin";
		}*/

		function conectar() {
			if(!($con=@mysql_connect($this->Servidor,$this->Usuario,$this->Clave))){
				echo"<h1> [:(] Error al conectar a la base de datos</h1>";	
				exit();
			}
			if (!@mysql_select_db($this->BaseDatos,$con)){
				echo "<h1> [:(] Error al seleccionar la base de datos</h1>";  
				exit();
			}
			$this->conect=$con;
			return true;	
		}	
	}
?>