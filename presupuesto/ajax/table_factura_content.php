<?php
if (!empty($dataFacturas['data'])) {
    $presupuesto = new presupuesto($conexion['local']);
    $i = 1;
    foreach ($dataFacturas['data'] as $fac) {

        //  echo '<pre>'; var_dump($fac); echo '</pre>';
        $rs_au = $auMedica->getOne(0, $fac['idFactura']);
        //var_dump($rs_au);
        // echo $rs_au['idauditoria_medica'];
        $Presupuesto = $presupuesto->getPresupuestoByFactura($rs_au['idFactura']);
        //var_dump($Presupuesto);
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><? echo (($Presupuesto['estado_presupuesto'] != '1')) ? '<strong class="label label-danger">No tiene presupuesto</strong>' : '<strong class="label label-success">Ya presupuestado</strong>' ?></td>
            <? if (empty($Presupuesto)): ?>
                <td width="61">

                    <span data-toggle="modal" href="#agregarPresupuesto" role="button" class="agregarNuevoPresupuesto" data-auditoria='<?php echo $rs_au['idauditoria_medica']; ?>' data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-primary"><i class="icon-plus"></i></button></span>

                </td>
            <? else: ?>
                <td width="130">

                    <button class="btn btn-success editarPresupuesto" role="button" data-toggle="modal" href="#editarPresupuesto"  data-presupuesto='<?php echo $Presupuesto['idpresupuesto']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class=" icon-check"></i></button>
                    <button class="btn btn-danger quitarPresupuesto"  data-presupuesto='<?php echo $Presupuesto['idpresupuesto']; ?>'  data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class="icon-ban-circle"></i></button>

                </td>
            <? endif ?>
        </tr>
    <?
    }
}?>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>presupuesto/js/presupuesto.js"></script>
