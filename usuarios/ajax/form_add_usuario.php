<form id="frmUsuario" class="formulario">
	<table class="responsive table">
		<thead>
			<tr>
				<th colspan="2"><div id="mensaje"></div></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><label>Nombres</label></td>
				<td><input type="text" name="nombres" id="nombres" class="validate[required,funcCall[_validarOnlyText]]" /></td>
			</tr>
			<tr>
				<td><label>Apellidos</label></td>
				<td><input type="text" name="apellidos" id="apellidos" class="validate[required,funcCall[_validarOnlyText]]" /></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type="email" name="email" id="email" class="validate[required,custom[email]]" /></td>
			</tr>
			<tr>
				<td><label>Usuario</label></td>
				<td><input type="text" name="usuario" id="usuario" class="validate[required,funcCall[_validarOnlyText]]" /></td>
			</tr>
			<tr>
				<td><label>Contraseña</label></td>
				<td><input type="password" name="password" id="password" class="validate[required,minSize[6]]" /></td>
			</tr>
			<tr>
				<td><label>Estado</label></td>
				<td>
					<span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
					<span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

				</td>
			</tr>
		</tbody>
	</table>
</form>