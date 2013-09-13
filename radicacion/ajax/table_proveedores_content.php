<?php
$i = 1;
if (!empty($dataProveedores['data'])) {
    foreach ($dataProveedores['data'] as $d) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $d['idproveedor'] ?></td>
            <td><?= $d['desTipod'] . ' ' . $d['nodocumento'] . (($d['idtipo_doc'] == '2') ? ' - ' . $d['dv'] : '') ?></td>
            <td><?= $d['nombre'] ?></td>
            <td><?= ($d['estadoProveedor'] == 1) ? 'Activo' : 'Inactivo' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $d['idproveedor']; ?>" data-section="radicacion" data-action="proveedor"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $d['idproveedor']; ?>" data-section="radicacion" data-action="proveedor"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
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
}?>

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


    var page_total = <?php echo ($dataProveedores['total'] > 1) ? $dataProveedores['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<?php echo $_REQUEST['case'] ?>');
</script>