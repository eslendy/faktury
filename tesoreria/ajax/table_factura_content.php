<?php
if (!empty($dataTesoreria)) {


    $i = 1;
    foreach ($dataTesoreria as $fac) {

        $HaveTesoreria = $tesoreria->getTesoreriaByFactura($fac['idFactura']);
        //var_dump($HaveContabilidad);
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><? echo ((!$HaveTesoreria)) ? ' <strong class="label label-danger">Sin tesoreria</strong>' : '<strong class="label label-success">Tesoreria realizada</strong>' ?></td>
            <? if (empty($HaveTesoreria)): ?>
                <td width="61">

                    <span class="agregarNuevaTesoreria" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-primary"><i class="icon-plus"></i></button></span>

                </td>
            <? else: ?>
                <td width="130">

                    <button class="btn btn-success editarTesoreria"   data-tesoreria='<?php echo $HaveTesoreria['idtesoreria']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class=" icon-check"></i></button>
                    <button class="btn btn-danger quitarTesoreria"  data-tesoreria='<?php echo $HaveTesoreria['idtesoreria']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class="icon-ban-circle"></i></button>

                </td>
            <? endif ?>
        </tr>
    <?
    }
}
else {
     echo '<tr><td colspan=8><em>No hay resultados...</em></td></tr>';
}
?>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>tesoreria/js/tesoreria.js"></script>
<script>
    createPaginated();
    </script>