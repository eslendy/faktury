<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");

include("../contabilidad/classes/contabilidad_class.php");
$contabilidad = new contabilidad($conexion['local']);
if (empty($_REQUEST['page'])) {
    $_REQUEST['page'] = 1;
}
$dataContabilidad = $contabilidad->getContabilidadByPaged($_REQUEST['page']);
//var_dump($dataContabilidad);
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
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>contabilidad/js/contabilidad.js"></script>