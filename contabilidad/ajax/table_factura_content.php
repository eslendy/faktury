<?php
if (empty($_REQUEST['page'])) {
    $_REQUEST['page'] = 1;
}
if (!empty($dataContabilidad['data'])) {
    $i = 1;
    
    foreach ($dataContabilidad['data'] as $fac) {

        $HaveContabilidad = $contabilidad->getContabilidadByFactura($fac['idFactura']);
        //var_dump($HaveContabilidad);
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><? echo ((!$HaveContabilidad)) ? '<strong class="label label-danger">Sin contabilidad</strong>' : '<strong class="label label-success">Contabilidad realizada</strong>' ?></td>
            <? if (empty($HaveContabilidad)): ?>
                <td width="61">

                    <span class="agregarNuevaContabilidad" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-primary"><i class="icon-plus"></i></button></span>

                </td>
            <? else: ?>
                <td width="130">

                    <button class="btn btn-success editarContabilidad"   data-contabilidad='<?php echo $HaveContabilidad['idcontabilidad']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class=" icon-check"></i></button>
                    <button class="btn btn-danger quitarContabilidad"  data-contabilidad='<?php echo $HaveContabilidad['idcontabilidad']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class="icon-ban-circle"></i></button>

                </td>
            <? endif ?>
        </tr>
    <?
    }
}
else{
    echo '<tr><td colspan=8><em>No hay resultados...</em></td></tr>';
}
?>
<input type="hidden" id="nombre_archivo" value="/contabilidad/index_contabilidad" />

<script type="text/javascript" src="<? echo $SERVER_NAME; ?>contabilidad/js/contabilidad.js"></script>
<script>
    var page_total = <?php echo ($dataContabilidad['total'] > 1) ? $dataContabilidad['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['action'] ?>');
</script>