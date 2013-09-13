<?php
$i = 1;
if (!empty($dataFacturas['data'])) {
    foreach ($dataFacturas['data'] as $fac) {
        $rs_au = "";
        $rs_au = $au->getOne(0, $fac['idf'], "au.estado=1");
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= $fac['fecha_radicacion'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><?= ($fac['estado_factura'] == 1) ? '<strong class="label label-success">Activa</strong>' : '<strong class="label label-danger">Anulada</strong>' ?></td>
            <? if (empty($rs_au)): ?>
                <td width="61">
                    <a>
                        <span class="adicionarBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?>  <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?> title="Nueva Auditoría"><button class="btn btn-success"><i class="icon-plus"></i></button></span>
                    </a>
                </td>
            <? else: ?>
                <td width="61">
                    <a>
                        <span class="verBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> data-auditor="<? echo $rs_au['idauditoria_financiera'] ?>" <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?> title="Ver auditorías realizadas"><button class="btn btn-primary"><i class=" icon-check"></i></button></span>
                    </a>
                </td>
            <? endif; ?>
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
<script>
    var page_total = <?php echo ($dataFacturas['total'] > 1) ? $dataFacturas['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['action'] ?>');
</script>