<?
$i = 1;
if (!empty($dataFacturas)) {
    foreach ($dataFacturas['data'] as $fac) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= $fac['fecha_radicacion'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><?= ($fac['estado_factura'] == 1) ? 'Activa' : 'Anulada' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $fac['idf']; ?>" data-section="radicacion" data-action="factura"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $fac['idf']; ?>" data-section="radicacion" data-action="factura"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
                </a>
            </td>
        </tr>
        <?
    }
} else {
    ?>
    <tr class="elemetoBusqueda">
        <td colspan="9" align="center">
            <b><em>No hay registros para tu busqueda.</em></b>
        </td>
    </tr>
        <?
    }
    ?>
<input type="hidden" id="nombre_archivo_" value="/radicacion/ajax/busqueda.php" />
<input type="hidden" id="term" value="<?php echo $_REQUEST['term'] ?>" />
<input type="hidden" id="type" value="<?php echo $_REQUEST['type'] ?>" />

<script>

$(document).ready(function() {

    $('.anularBtn').click(function() {
        var action = $(this).attr('data-action');
        var record = $(this).attr('data-record');
        if (confirm('¿Esta seguro de desactivar este registro?')) {
            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/save.php?type=null' + action, {id: record}, function(html_response) {
                switch (html_response) {
                    case '1':
                        alert(action + " Desactivado con Éxito!!");
                        $("#dialog-addModRad").remove();
                        _loadContenido($('#nombre_archivo').val());
                        break;
                    default:
                        _msgerror(html_response, "#mensaje");
                        break;
                }
            });
        }

    })

    $('.editarBtn').click(function() {

        var action = $(this).attr('data-action');
        var record = $(this).attr('data-record');
        $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/form_edit_radicacion.php', {case: action, id: record}, function(data) {
            console.log(data)
            $('#loadContentAjaxForms').modal({show: true});
            $('.modal-body').html(data)
            loadStylesCheckRadio();

        })
    })
})


    
    var page_total = <?php echo ($dataPacientes['total'] > 1) ? $dataPacientes['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<?php echo $_REQUEST['case'] ?>');
</script>