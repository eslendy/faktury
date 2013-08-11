<form id="frmUsuario" class="formulario">
    <table class="responsive table table-striped">
        <thead>
            <tr>
                <th colspan="2"><div id="mensaje"></div></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><label>Nombres</label></td>
                <td><input type="text" name="nombres" id="nombres" class="validate[required,funcCall[_validarOnlyText]]" data-prompt-position="centerRight:1,-8"/></td>
            </tr>
            <tr>
                <td><label>Apellidos</label></td>
                <td><input type="text" name="apellidos" id="apellidos" class="validate[required,funcCall[_validarOnlyText]]" data-prompt-position="centerRight:1,-8" /></td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td><input type="email" name="email" id="email" class="validate[required,custom[email]]" data-prompt-position="centerRight:1,-8" /></td>
            </tr>
            <tr>
                <td><label>Usuario</label></td>
                <td><input type="text" name="usuario" id="usuario" class="validate[required,funcCall[_validarOnlyText]]" data-prompt-position="centerRight:1,-5" /></td>
            </tr>
            <tr>
                <td><label>Contraseña</label></td>
                <td><input type="password" name="password" id="password" class="validate[required,minSize[6]]" data-prompt-position="centerRight:1,-5" /></td>
            </tr>
            <tr>
                <td><label>Estado</label></td>
                <td>
                    <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" /></span>
                    <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                </td>
            </tr>

        </tbody>
    </table>
</form>

<table class="table table-btn" style="margin-top: 10px;">
    <tbody><tr>
        <td width="70%"></td>
        <td width="30%">
            <button class="btn btn-success saveNewuser btn-large pull-right">Guardar nuevo usuario</button>
        </td>
    </tr>
</tbody></table>
     
        

<input type="hidden" id="nombre_archivo" value="/usuarios/index_usuarios.php" />


<script>
    $('.saveNewuser').submit(function(e) {
        $.preventDefault(e);

    })
    $('.saveNewuser').click(function(e) {

        if ($("#frmUsuario").validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'usuarios/ajax/save.php?type=addUser', $("#frmUsuario").serialize(), function(data) {
                console.log('entra: ' + data);
                switch (data) {
                    case '1':
                        alert("Agregado usuario con Éxito!!");
                        _loadContenido($('#nombre_archivo').val());
                        $('.modal').modal('hide')
                        $('#content_').collapse('show');
                        break;
                    default:
                        _msgerror(data, "#mensaje");
                        break;
                }
            })
        }

    })
</script>
