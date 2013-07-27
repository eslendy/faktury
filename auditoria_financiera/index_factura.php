<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("../radicacion/clases/facturas_class.php");
include("clases/auditoria_financiera.php");
$facturas = new facturas($conexion['local']);
$au = new auditoria_financiera($conexion['local']);
$dataFacturas = $facturas->getallFacturas("f.estado=1");
//var_dump($dataFacturas);
include '../requestFunctionsJavascript.php';
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">
            <form action="#" class="form-inline">
                <input name="q" class="table-form" type="text"  placeholder="Keywords: Ruby, Rails, Django" >
                <button type="submit" class="btn btn-primary"> <i class="icon-search icon-white"></i></button>
            </form>
        </span>

        <div class="clear"></div>


    </div>
    <input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME ?>auditoria_financiera/index_factura" />
    
    <div id="contenido">
        <table id="reporte" class="responsive table">
            <thead>
                <? /* <tr id="trBuscar" class="oculto">
                  <td></td>
                  <td><input type="search" id="fecha_rad_search" placeholder="Buscar x fecha" class="search_txt fecha" /></td>
                  <td><input type="search" id="factura_search" placeholder="Buscar x No. Factura" class="search_txt" /></td>
                  <td></td>
                  <td><input type="search" id="proveedor_search" placeholder="Buscar x proveedor" class="search_txt" /></td>
                  <td><input type="search" id="paciente_search" placeholder="Buscar x paciente" class="search_txt" /></td>
                  <td></td>
                  <td></td>
                  </tr> */ ?>
                <tr>
                    <th title="No. Radicado">RAD</th>
                    <th title="Fecha Radicación">FECHA RAD.</th>
                    <th>NO. FACTURA</th>
                    <th>VALOR</th>
                    <th>PROVEEDOR</th>
                    <th>PACIENTE</th>
                    <th>ESTADO</th>
                    <th></th>

                </tr>
            </thead>
            <tbody id="lista">
                <?
                $i = 1;
                foreach ($dataFacturas as $fac) {
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
                        <td><?= ($fac['estado_factura'] == 1) ? 'Activa' : 'Anulada' ?></td>
                        <? if (empty($rs_au)): ?>
                            <td width="61">
                                <a>
                                    <span class="adicionarBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?>  <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?> title="Nueva Auditoría"><button class="btn btn-success"><i class="icon-plus"></i></button></span>
                                </a>
                            </td>
                        <? else: ?>
                            <td width="61">
                                <a>
                                    <span class="verBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> data-auditor="<? echo $rs_au['idauditoria_financiera'] ?>" <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?> title="Ver auditorías realizadas"><button class="btn btn-primary"><i class=" icon-check"></i></button></span>
                                </a>
                            </td>
                        <? endif; ?>
                    </tr>
                <? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" id="pager" class="holder" align="center">

                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_financiera/js/factura.js"></script>
</div>