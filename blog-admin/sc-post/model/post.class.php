 <?php
require_once '../../functions/conexion.class.php';

class post{
	var $con;
	function post(){
		$this->con = new DBManager;		
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

	function enlistar( $estatus ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$estatus );
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function enlistarLimit( $estatus ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d ORDER BY pst_id DESC LIMIT 5;";
			$sql = sprintf($sql ,$estatus );
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
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus in( 1,3 ) AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$where);
			//echo $sql;
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListTagsAll( $estatus ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d  ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$estatus);
			//echo $sql;
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListTags( $id, $estatus ){
		if($this->con->conectar()==true){
			$sql = "SELECT * FROM tbl_post WHERE usu_id = ".$id." AND pst_estatus = %d  ORDER BY pst_id DESC;";
			$sql = sprintf($sql ,$estatus);
			//echo $sql;
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListWhereByGruopLimit( $where, $grupo, $limit ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus in( 1,3 ) AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
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

	function getListByGruopLimitAll( $where, $estatus, $grupo, $limit ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE pst_estatus = %d AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
			$sql = sprintf($sql, $estatus, $where);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function getListByGruopLimit( $id, $where, $estatus, $grupo, $limit ){
		if($this->con->conectar()==true){
			$where = ( empty($where) )? '' : ' AND ' . $where;
			$sql = "SELECT * FROM tbl_post WHERE usu_id = ".$id." AND pst_estatus = %d AND pst_fecha <= CURDATE() %s  ORDER BY pst_id DESC LIMIT " . $limit['ini'] . "," . $limit['fin'] . ";";
			$sql = sprintf($sql, $estatus, $where);
			$data	= $this->Execute(mysql_query($sql));
			return $data;
		}
	}

	function delete( $cat_id ){
		if($this->con->conectar()==true){
			$sql = "DELETE FROM tbl_post WHERE pst_id = %d;";
			$sql = sprintf($sql, $cat_id);
			$bool	= mysql_query($sql);
			return $bool;
		}
	}

	function depurar(){
		if($this->con->conectar()==true){
			$sql = "DELETE FROM `tbl_post` WHERE pst_estatus = 0 AND pst_fecha <= DATE_ADD(CURDATE(), INTERVAL -30 DAY)";
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
			//echo $sql;
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