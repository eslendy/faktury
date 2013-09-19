<?php
include("contabilidad/classes/contabilidad_class.php");
$contabilidad = new contabilidad($conexion['local']);
if (empty($_REQUEST['page'])) {
    $_REQUEST['page'] = 1;
}
$dataContabilidad = $contabilidad->getContabilidadByPaged($_REQUEST['page']);

include '../requestFunctionsJavascript.php';

?>

<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="ID" >
            <button type="submit" class="btn btn-primary search-btn-2" data-case="contabilidad"> <i class="icon-search icon-white"></i></button>
            <h4>Filtrar por:</h4>
            <div class="busqueda-radio">
                <label class="pull-left" for="id">Numero Radicado:</label> <input type="radio" name="type" value="f.no_radicado" id="id" class="search-radio" data-related="Numero radicado" checked>
                <label class="pull-left" for="no-factura">Nro. Factura:</label><input type="radio" name="type" value="f.numero_factura" id="no-factura" class="search-radio" data-related="Numero factura">
                <label class="pull-left" for="proveedor">Proveedor:</label><input type="radio" name="type" value="pro.nombre" id="proveedor" class="search-radio" data-related="Proveedor">
                <label class="pull-left" for="paciente">Paciente:</label><input type="radio" name="type" value="pa.nombre" id="paciente" class="search-radio" data-related="Paciente">
            </div>

           <script>
                loadStylesCheckRadio();
                var loadSearch__ = function(){
                    
                    $('.search-radio').click(function() {
                        
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                        
                    })

                    $('.search-btn-2').click(function() {
                        loadSearch($(this).attr('data-case'), $('.iradio_flat-blue.checked .search-radio').val(), $('.search-box').val());
                    })

             
                }
              $(window).load(function(){
                  loadSearch__();
              })
                
            </script>
        </span>

        <div class="clear"></div>


    </div>
    <input type="hidden" id="nombre_archivo" value="/contabilidad/index_contabilidad.php" />
    <div id="contenedor">
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

    </div>

</div>



<script>
    
    $(document).ready(function(){
        $('.btn.btn-primary.nuevo').hide();
    })
    
</script>