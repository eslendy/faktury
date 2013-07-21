<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/facturas_class.php");
$facturas = new facturas($conexion['local']);
$dataFacturas = $facturas->getallFacturas();
//var_dump($dataFacturas);
?>


<div class="block-heading">
    <a href="#content_" data-toggle="collapse">
        <span>Table

            <span class="pull-right">
                <button class="busqueda btn btn-success">
                    Buscar
                </button>
                <button class="btn btn-primary nuevafactura">
                    Nueva Factura
                </button>
                <button data-toggle="modal" class="btn btn-primary" href="#myModal1"><i class="icon-cog"></i></button>
            </span>

        </span>
    </a>

</div>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">
            <form action="#" class="form-inline">
                <input name="q" class="table-form" type="text"  placeholder="Keywords: Ruby, Rails, Django" >
                <button type="submit" class="btn btn-primary"> <i class="icon-search icon-white"></i></button>
            </form>
        </span>
        <span class="pull-right">

            <button class="btn btn-danger"><i class="icon-chevron-left"></i></button>
            <button class="btn btn-danger"><i class="icon-chevron-right"></i></button>
        </span>
        <div class="clear"></div>


    </div>

    <input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME ?>radicacion/index_factura.php" />



    <div id="contenido" >
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
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista">
                <?
                $i = 1;
                foreach ($dataFacturas as $fac) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $fac['no_radicado'] ?></td>
                        <td><?= $fac['fecha_radicacion'] ?></td>
                        <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
                        <td><?= $fac['valor'] ?></td>
                        <td><?= $fac['proveedor_nombre'] ?></td>
                        <td><?= $fac['paciente_nombre'] ?></td>
                        <td><?= ($fac['estado_factura'] == 1) ? 'Activa' : 'Anulada' ?></td>
                        <td>
                            <a>
                                <span class="editarBtn" onclick="_editarReg(<?= $fac['idf'] ?>)"></span>
                            </a>
                        </td>
                        <td>
                            <a>
                                <span class="anularBtn" onclick="_anularReg(<?= $fac['idf'] ?>)"></span>
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
    <script>
                                    $(document).ready(function() {
                                        $('.nuevafactura').click(function() {
                                            $('.add_factura').fadeIn();
                                            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/form_add_radicacion.php', {case: 'factura'}, function(data) {
                                                console.log(data)
                                                $('.load_content_factura').html(data);
                                            })
                                        })
                                    })
    </script>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/factura.js"></script>
</div>
<div class="clear"></div>
<div class="block span12 add_factura" style="display: none">
    <p class="block-heading">
        <span class="pull-right">

            <button class="btn btn-danger" onclick="$('.add_factura').fadeOut();$('#content_').collapse('show');"> Close <i class="icon-cog"></i></button>
        </span>

        <span>Nueva Factura</span>
    </p>                  
    <div class="block-body">
        <div class="load_content_factura"></div>
    </div>

</div>