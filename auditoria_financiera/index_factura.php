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

            <input name="q" class="table-form search-box" type="text"  placeholder="ID" >
            <button type="submit" class="btn btn-primary search-btn-2" data-case="<? echo $_REQUEST['section'] ?>"> <i class="icon-search icon-white"></i></button>
            <h4>Filtrar por:</h4>
            <div class="busqueda-radio">
                <label class="pull-left" for="id">Numero Radicado:</label> <input type="radio" name="type" value="f.no_radicado" id="id" class="search-radio" data-related="Numero radicado" checked>
                <label class="pull-left" for="no-factura">Nro. Factura:</label><input type="radio" name="type" value="f.numero_factura" id="no-factura" class="search-radio" data-related="Numero factura">
                <label class="pull-left" for="proveedor">Proveedor:</label><input type="radio" name="type" value="pro.nombre" id="proveedor" class="search-radio" data-related="Proveedor">
                <label class="pull-left" for="paciente">Paciente:</label><input type="radio" name="type" value="pa.nombre" id="paciente" class="search-radio" data-related="Paciente">
            </div>

            <script>
                $(document).ready(function() {
                    $('.search-radio').click(function() {
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                    })

                    $('.search-btn-2').click(function() {
                        loadSearch($(this).attr('data-case'), $('.iradio_flat-blue.checked .search-radio').val(), $('.search-box').val());
                    })

                })
                loadStylesCheckRadio();
            </script>
        </span>



    </div>
    <input type="hidden" id="nombre_archivo" value="/auditoria_financiera/index_factura" />

    <div id="contenido">
        <table id="reporte" class="responsive table table-hover">
            <thead>

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
                <? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" id="pager" class="holder" align="center">

                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_financiera/js/factura.js"></script>
</div>