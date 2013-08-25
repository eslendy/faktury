<form id="frmModulo" class="formulario">
    <table class="responsive table">
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
<table class="table table-btn">
    <tbody><tr>
        <td width="90%"></td>
        <td width="10%">
            <button class="btn btn-success guardar-formulario nuevo-modulo btn-large">Guardar</button>
        </td>
    </tr>
</tbody></table>
<input type="hidden" id="nombre_archivo" value="/modulos/index_modulos.php" />
<script>
    $('.guardar-formulario.nuevo-modulo').submit(function(e) {
        $.preventDefault(e);

    })


    $('.guardar-formulario.nuevo-modulo').click(function(e) {

        
        if ($('#frmModulo').validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'modulos/ajax/save.php?type=addModulo', $('#frmModulo').serialize(), function(data) {
                switch (data) {
                    case '1':
                        alert("Modulo agregado con Éxito!!");
                        $('.add').fadeOut();
                        $('#content_').collapse('show');
                        _loadContenido($('#nombre_archivo').val());
                        break;
                    default:
                        _msgerror(data, "#mensaje");
                        break;
                }
            })
        }

    })
</script>