<form id="frmPerfil" class="formulario">
	<table>
		<thead>
			<tr>
				<th colspan="2"><div id="mensaje"></div></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><label>Nombres</label></td>
				<td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarOnlyText]]" /></td>
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