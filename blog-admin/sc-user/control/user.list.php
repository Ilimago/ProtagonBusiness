<?php
	require_once '../model/usuario.class.php';
	$mdb = new usuario();
if( $_SESSION['perfil'] == 1 ){
	$user = $mdb->user();

	if (empty($_GET['U'])) {
		$users = $mdb->userList();
		$template.='<label>TODOS LOS USUARIOS</label>
                    <table id="example1" class="table table-mailbox table-striped" data-page-length="15">
                        <thead>
                            <tr>
                                <th width="60%">'.$GLOBALS[$ln]['store'][9].'</th><!-- nombre -->
                                <th width="40%">Tipo de usuario</th>
                                <th width="100px">'.$GLOBALS[$ln]['store'][10].'</th><!-- Opciones -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>';
		foreach ($users as $value) {
			if ($value['usu_perfil']==2) { $permiso='General';}
			if ($value['usu_perfil']==3) { $permiso='Principal';}
			if ($value['usu_perfil']==4) { $permiso='Diseño';}
			if ($value['usu_perfil']==5) { $permiso='Administracion de Productos';}
			if ($value['usu_perfil']==6) { $permiso='Administracion de CeDis';}
			if ($value['usu_perfil']==7) { $permiso='Administracion de Distribuidores';}
			$template.='<tr id="user-' . $value['usu_id'] . '">
				            <td align="left">'.$value['usu_nombre'].'</td>
				            <td align="left">'.$permiso.'</td>
				            <td align="right"><span><a href="editar.php?U='.$value['usu_id'].'"><i class="fa fa-pencil pre_edit-sm"></i></a>
				            					<a href="javascript:deleteUser(' . $value['usu_id'] . ')"><i class="fa fa-trash-o pre_erase-sm pre_eraseFN"></i></a></span></td>
				        </tr>';
	        
		}
		$template.='</tfoot>
                </table>';
	}else{
		$users = $mdb->getUser($_GET['U']);
		if( !empty($users[0]['usu_foto']) ){
			$template = '<img id="imgPortada" src="../../files/user/' . $users[0]['usu_foto'] . '" class="img-thumbnail" style="width:100%; " />
	                    <div class="featured-image-selection" style="display:none;">
	                        <i class="fa fa-picture-o"></i><br>
	                    </div>
	                    <center id="quitImg"></center>';
		}
		else{
			$template = '<img id="imgPortada" src="" class="img-thumbnail" style="width:100%; display:none;" />
	                    <div class="featured-image-selection">
	                        <i class="fa fa-picture-o"></i><br>
	                    </div>
	                    <center id="quitImg"></center>';
		}

		$nombre = $users[0]['usu_nombre'];
		$descripcion = $users[0]['usu_sexo'];
		$tuister = $users[0]['usu_caduca'];
		$face = $users[0]['usu_facebook'];
		$mail = $users[0]['usu_mail'];
		$id=$_GET['U'];
		$option='<option value="'. $users[0]['usu_perfil'] .'">'.$permiso.'</option>';

	}								
}else{
	$users = $mdb->getUser($_SESSION['usu_id']);
	if( !empty($users[0]['usu_foto']) ){
		$template = '<img id="imgPortada" src="../../files/user/' . $users[0]['usu_foto'] . '" class="img-thumbnail" style="width:100%; " />
                    <div class="featured-image-selection" style="display:none;">
                        <i class="fa fa-picture-o"></i><br>
                    </div>
                    <center id="quitImg"></center>
                    <div class="custom-input-file cat_lbl" style="position:absolute; top:75%; left:22%;">
                        <input type="file" size="1" id="img_croquis" name="imagen" class="input-file" onchange="loadPerfil(this)" />
                        <h5 id="nombre_img_3" style="display:none;"></h5>
                        <p style="display:none;"><strong id="peso_img_3"></strong></p>
                        <center>
                            <button class="btn btn-primary full-width" id="btnLoad">
                                <i class="fa fa-picture-o"></i> Cambiar imagen de perfil
                            </button>
                        </center>
                    </div>';
	}
	else{
		$template = '<img id="imgPortada" src="" class="img-thumbnail" style="width:100%; display:none;" />
                    <div class="featured-image-selection">
                        <i class="fa fa-picture-o"></i><br>
                    </div>
                    <center id="quitImg"></center>
                    <div class="custom-input-file cat_lbl" style="position:absolute; top:75%; left:22%;">
                        <input type="file" size="1" id="img_croquis" name="imagen" class="input-file" onchange="loadPerfil(this)" />
                        <h5 id="nombre_img_3" style="display:none;"></h5>
                        <p style="display:none;"><strong id="peso_img_3"></strong></p>
                        <center>
                            <button class="btn btn-primary full-width" id="btnLoad">
                                <i class="fa fa-picture-o"></i> Cambiar imagen de perfil
                            </button>
                        </center>
                    </div>';
	}
	//$tbl_users = '<img id="imgPerfil" src="../../files/img/user.jpg" class="img-thumbnail img-circle" style="max-width:350px" />';
}
	
?>