<?php
//require_once '../../functions/conexion.class.php';

class usuario{
	var $con;
	function usuario(){
		$this->con = new DBManager;		
	}

	function user(){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_users WHERE usu_id = 1;";
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function userList(){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_users WHERE usu_id <> 1 ORDER BY usu_id DESC;";
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getUser( $usu_id ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_users WHERE usu_id = %d;";
			$sql = sprintf($sql, $usu_id);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function insert($array){
		if($this->con->conectar()==true){
			foreach ($array as $nombre => $valor){
				$campos .= $nombre . ",";
				$datos  .= "'".$valor . "',";
			}
			$campos .= '['; $campos = str_replace(',[','',$campos);
			$datos .= '['; $datos = str_replace(',[','',$datos);
			$sql = "INSERT INTO tbl_users(".$campos.") VALUES (".$datos.")";

			$bool = mysql_query($sql);
			return $bool;
		}
	}

	function updateNamePost($name,$id){
		if($this->con->conectar()==true){
			$sql = "UPDATE tbl_post SET usu_autor='".$name ."' WHERE usu_id=".$id;
			$bool = mysql_query($sql);
			return $bool;
		}
	}
	
	function update($array,$condicion){
		if($this->con->conectar()==true){
			foreach ($array as $nombre => $valor){
				$valores .= $nombre . "='" . $valor . "',";
			}
			$valores .= '['; $valores = str_replace(',[','',$valores);
			$sql = "UPDATE tbl_users SET ".$valores ." WHERE ".$condicion;
			
			$bool = mysql_query($sql);
			return $bool;
		}
	}

	function delete( $usu_id ){
		if($this->con->conectar()==true){
			$sql = "DELETE FROM tbl_users WHERE usu_id = %d;";
			$sql = sprintf($sql, $usu_id);
			$bool	= mysql_query($sql);
			return $bool;
		}
	}
	
	function print_a($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	
	function Execute($data){
		while($reg = mysql_fetch_assoc($data)){
			$registros[] = $reg;
		}
		
		if (empty($registros)){
			$registros = array();
		}
		
		return $registros;
	}
}
?>