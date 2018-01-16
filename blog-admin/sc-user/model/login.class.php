<?php
require_once '../../functions/conexion.class.php';
require_once '../../functions/conn.session.php';

class login{
	var $con;
	var $session;
	function login(){
		$this->con = new DBManager;
		$this->session = new conn_session;
	}
	
	function access($mail,$pass){ 
		if($this->validate_email($mail))
		{
			if($this->con->conectar()==true){
				$sql = "SELECT * FROM tbl_users WHERE usu_mail = '%s' AND usu_password = '%s'";
				$sql = sprintf($sql, $mail, md5($pass));
				
				$data	= $this->Execute(mysql_query($sql));
				
				if (count($data) == 0)
				{
					$access = false;
					$this->session->session_destroyer();
				}
				else
				{
					$access = true;
					$this->session->session_starter($data);
				}
			}
		}
		else
		{
			$access = false;
			$this->session->session_destroyer();
		}
		
		return $access;		
	}
	
	function validate_email($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			return true;
		}
		return false;
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
	
	function new_password($email){
		if($this->valida_recovery($email))
		{
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890*_#/";
			$pass = "";
			for($i = 0; $i < 8; $i++) {
				$pass .= substr($str,rand(0,62),1);
			}
			
			$_USER['usu_password'] = md5($pass);
			
			if($this->update($_USER,"usu_mail='" . $email . "'")){
				$bool['return'] = true;
			}
			else{
				$bool['return'] = false;
			}
			$bool['pass'] = $pass;			
		}
		else
		{
			$bool['return'] = false;
		}
		return $bool;
	}
	
	function valida_recovery($mail){ 
		if($this->validate_email($mail))
		{
			if($this->con->conectar()==true){
				$sql = "SELECT * FROM tbl_users WHERE usu_mail = '%s'";
				$sql = sprintf($sql, $mail);
				
				$data	= $this->Execute(mysql_query($sql));
				
				if (count($data) == 0)
				{
					$access = false;
				}
				else
				{
					$access = true;
				}
			}
		}
		else
		{
			$access = false;
		}	
		
		return $access;	
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