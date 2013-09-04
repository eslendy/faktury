<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");

include("../radicacion/clases/facturas_class.php");
include("../auditoria_medica/clases/auMedica_class.php");
include("../presupuesto/classes/presupuesto_class.php");
$facturas = new facturas($conexion['local']);
$campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, 
    IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera, f.idFactura as idFactura";
$where = "f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor = " . $_SESSION['usrid'] . ") and f.estado=1";
$dataFacturas = $facturas->getall($campos, $where);
//var_dump($dataFacturas);
$auMedica = new auMedica($conexion['local']);


include '../requestFunctionsJavascript.php';
//var_dump($dataUsers);
?>

<div id="contenido">

    <table  id="reporte" class="responsive table table-hover">
        <thead>

            <tr>
                <th title="No. Radicado">RAD</th>
                <th>NO. FACTURA</th>
                <th>VALOR</th>
                <th>PROVEEDOR</th>
                <th>PACIENTE</th>
                <th>ESTADO</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <?php
            $presupuesto = new presupuesto($conexion['local']);
            $i = 1;
            foreach ($dataFacturas as $fac) {

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
                    <td><? echo (($Presupuesto['estado_presupuesto'] != '1')) ? 'No tiene presupuesto' : 'Ya presupuestado' ?></td>
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
            <? } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" id="pager" class="holder" align="center">

                </td>
            </tr>
        </tfoot>
    </table>

</div>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>presupuesto/js/presupuesto.js"></script>