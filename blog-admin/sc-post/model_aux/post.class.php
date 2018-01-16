 <?php
// require_once '../../functions/conexion.class.php';

class post{
	var $con;
	function post(){
		$this->con = new DBManager;		
	}

	function actualizarprogramados(){
		if($this->con->conectar()==true){
			$sql = "UPDATE `tbl_post` SET pst_estatus = 1 WHERE pst_estatus = 3 AND CONCAT(pst_fecha , ' ', pst_hora) <= NOW();";
			$bool	= mysql_query($sql);
			return $bool;
		}
	}

	function get( $post ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_id = %d;";
			$sql = sprintf($sql, $post);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getFriendly( $post ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_friendly like '%s';";
			$sql = sprintf($sql, $post);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getRelacionados( $rela ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_etiqueta LIKE '%".$rela."%' OR pst_categoria LIKE '%".$rela."%' ORDER BY RAND() DESC;";
			//$sql = sprintf($sql);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getRecientes( $rela ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus='".$rela."' ORDER BY pst_id DESC LIMIT 4;";
			//$sql = sprintf($sql);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function enlistarByGruop( $estatus, $grupo ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$estatus);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function enlistarByGruopLimit( $estatus, $grupo, $limit ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
			$sql = sprintf($sql ,$estatus);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListWhereByGruop( $where, $grupo ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus in( 1,3 ) AND CONCAT(pst_fecha , ' ', pst_hora) <= NOW() %s  ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$where);
			//echo $sql;
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListWhereByGruopLimit( $where, $grupo, $limit ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus in( 1,3 ) AND CONCAT(pst_fecha , ' ', pst_hora) <= NOW() %s  ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
			$sql = sprintf($sql ,$where);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListByGruop( $where, $estatus, $grupo ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC;";
			$sql = sprintf($sql, $estatus, $where);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListByGruopLimit( $where, $estatus, $grupo, $limit ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
			$sql = sprintf($sql, $estatus, $where);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function delete( $cat_id ){
		if($this->con->conectar()==true){
			$sql = "DELETE FROM tbl_post WHERE cat_id = %d;";
			$sql = sprintf($sql, $cat_id);
			$bool	= mysql_query($sql);
			return $bool;
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
			$sql = "INSERT INTO tbl_post(".$campos.") VALUES (".$datos.")";

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
			$sql = "UPDATE tbl_post SET ".$valores ." WHERE ".$condicion;
		
			$bool = mysql_query($sql);
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