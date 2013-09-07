<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("../radicacion/clases/facturas_class.php");
$facturas = new facturas($conexion['local']);
$dataFacturas = $facturas->getallFacturas("f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor = " . $_SESSION['usrid'] . ")");
//var_dump($dataFacturas);
include '../requestFunctionsJavascript.php';
//echo "SELECT idFactura FROM auditoria_financiera WHERE id_auditor = ".$_SESSION['usrid'];
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
    <input type="hidden" id="nombre_archivo" value="/radicacion/index_factura.php" />
    

    <div id="contenido">
        <table id="reporte" class="responsive table">
            <thead>
                <? /* <tr id="trBuscar" class="oculto">
                  <td><input type="search" id="no_rad_search" placeholder="Rad" class="search_txt" size="4" /></td>
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
                    <th>AUD. FINANCIERA</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista">
                <? $i = 1;
                foreach ($dataFacturas['data'] as $fac) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $fac['no_radicado'] ?></td>
                        <td><?= $fac['fecha_radicacion'] ?></td>
                        <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
                        <td><?= $fac['valor'] ?></td>
                        <td><?= $fac['proveedor_nombre'] ?></td>
                        <td><?= $fac['paciente_nombre'] ?></td>
                        <td><?= ($fac['estado_factura'] == 1) ? '<strong class="label label-success">Activa</strong>' : '<strong class="label label-danger">Anulada</strong>' ?></td>
                        <td>

                        </td>
                        <td width="61">
                            <a>
                                <span class="btn btn-primary" onclick="_addAudMedica(<?= $fac['idf'] ?>)">Agregar Auditoria</span>
                            </a>
                        </td>
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
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>radicacion/js/factura.js"></script>
</div>