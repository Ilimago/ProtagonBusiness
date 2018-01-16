<?php
	require_once '../model/mdb.class.php';
	if(isset($_REQUEST['table']) && !empty($_REQUEST['table']))
	{
		$mdb 	= new mdb($_REQUEST['table']);
		$where  = '';
		if(!empty($_REQUEST['campo']))
		{
			if(!empty($_REQUEST['valor']))
				$where 	= $_REQUEST['campo'] . " = '" . $_REQUEST['valor'] . "'";			
		}
		echo json_encode($mdb->getData( $where ));
	}
?>