<form id="frmPerfil" class="formulario">
    <table class="responsive table">
        <thead>
            <tr>
                <th colspan="2"><div id="mensaje"></div></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><label>Nombres</label></td>
                <td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarOnlyText]]" data-prompt-position="bottomRight:1,-5" /></td>
            </tr>
            <tr>
                <td colspan="2"><label>Estado</label>
                    <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"  checked/> <span class="text-title">Activo</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" /> <span class="text-title">Inactivo</span>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<input type="hidden" id="nombre_archivo" value="/perfiles/index_perfil.php" />


<script>
    $(document).ready(function() {
        $('.guardar-formulario.nuevo').submit(function(e) {
            $.preventDefault(e);

        })
        $('.guardar-formulario.nuevo').click(function(e) {

            if ($('#frmPerfil').validationEngine('validate') == true) {
                $.post(init.XNG_WEBSITE_URL + 'perfiles/ajax/save.php?type=addPerfil', $('#frmPerfil').serialize(), function(data) {
                    console.log('entra: ' + data);
                    switch (data) {
                        case '1':
                            alert("Perfil Agregado con Éxito!!");
                            $("#dialog-addModRad").remove();
                            _loadContenido($('#nombre_archivo').val());
                            $('.modal').modal('hide');
                            $('.guardar-formulario').removeClass('nuevo');
                            break;
                        default:
                            _msgerror(data, "#mensaje");
                            break;
                    }
                })
            }

        })
    })

</script>