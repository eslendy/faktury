<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/facturas_class.php");
$facturas = new facturas($conexion['local']);
if(empty($_REQUEST['page'])){
  $_REQUEST['page'] = 1;  
}

$dataFacturas = $facturas->getAllFacturasPaginated($_REQUEST['page']);

include '../requestFunctionsJavascript.php';

?>


<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="ID" >
            <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action'] ?>"> <i class="icon-search icon-white"></i></button>
            <h4>Filtrar por:</h4>
            <div class="busqueda-radio">
                <label class="pull-left" for="id">Numero Radicado:</label> <input type="radio" name="type" value="f.no_radicado" id="id" class="search-radio" data-related="Numero radicado" checked>
                <label class="pull-left" for="fecha">Fecha Radicado:</label><input type="radio" name="type" value="f.fecha_radicacion" id="fecha" class="search-radio" data-related="Fecha Radicado">
                <label class="pull-left" for="no-factura">Nro. Factura:</label><input type="radio" name="type" value="f.numero_factura" id="no-factura" class="search-radio" data-related="Numero factura">
                <label class="pull-left" for="proveedor">Proveedor:</label><input type="radio" name="type" value="pro.nombre" id="proveedor" class="search-radio" data-related="Proveedor">
                <label class="pull-left" for="paciente">Paciente:</label><input type="radio" name="type" value="pa.nombre" id="paciente" class="search-radio" data-related="Paciente">
            </div>

            <script>
                $(document).ready(function() {
                    $('.checked .search-radio').click(function() {
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                    })
                })
            </script>
        </span>

        <div class="clear"></div>


    </div>

    <input type="hidden" id="nombre_archivo" value="/radicacion/index_factura" />



    <div id="contenido" >
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
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista" class="loadContentFromSearch">
                <?php
                $i = 1;
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
                        <td width="20">
                            <a>
                                <span class="editarBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="20">
                            <a>
                                <span class="anularBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-info"><i class="icon-ban-circle"></i></button></span>
                            </a>
                        </td>

                        <td width="20">
                            <a>
                                <span class="removeBtn" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-danger"><i class="icon-remove"></i></button></span>
                            </a>
                        </td>

                    </tr>
                <? } ?>
            </tbody>
            
        </table>

    </div>

    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/factura.js"></script>
</div>
<script>
    var page_total = <?php echo ($dataFacturas['total'] > 1) ? $dataFacturas['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total);
</script>
<?php 
// var_dump($_REQUEST);
?>