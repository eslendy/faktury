<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/usuarios_class.php');
$usuario = new usuarios($conexion['local']);
$data = $usuario->getUser($_POST['idusuarios']);
?>

<form id="frmUsuario" class="formulario">
	<input type="hidden" name="idusuarios" id="idusuarios" value="<?=$data['idusuarios']?>" />
	<table class="responsive table">
		<thead>
			<tr>
				<th colspan="2"><div id="mensaje"></div></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><label>Nombres</label></td>
				<td><input type="text" name="nombres" id="nombres" class="validate[required,funcCall[_validarOnlyText]]" value="<?=$data['nombres']?>" /></td>
			</tr>
			<tr>
				<td><label>Apellidos</label></td>
				<td><input type="text" name="apellidos" id="apellidos" class="validate[required,funcCall[_validarOnlyText]]" value="<?=$data['apellidos']?>" /></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type="email" name="email" id="email" class="validate[required,custom[email]]" value="<?=$data['email']?>" /></td>
			</tr>
			<tr>
				<td><label>Usuario</label></td>
				<td><input type="text" name="usuario" id="usuario" class="validate[required,funcCall[_validarOnlyText]]" value="<?=$data['usuario']?>" /></td>
			</tr>
			<tr>
				<td><label>Contraseña</label></td>
				<td><input type="password" name="password" id="password" class="validate[required,minSize[6]]" value="<?=$data['password']?>" /></td>
			</tr>
			<tr>
				<td><label>Estado</label></td>
				<td>
					<span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($data['estado']==1)?'checked="checked"':''?> /></span>
					<span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($data['estado']==0)?'checked="checked"':''?> /></span>

				</td>
			</tr>
		</tbody>
	</table>
</form>