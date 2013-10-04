<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("../radicacion/clases/facturas_class.php");
include("clases/auMedica_class.php");
include("../radicacion/clases/glosas_class.php");

$facturas = new facturas($conexion['local']);
if (empty($_REQUEST['page'])) {
    $_REQUEST['page'] = 1;
}

$campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, 
    IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera, f.idFactura as idFactura";

$where_ = (($_SESSION['perfil'] == 1)) ? " ) and " : " WHERE id_auditor = " . $_SESSION["usrid"] . ") and ";

$where = "f.idFactura IN (SELECT idFactura FROM auditoria_financiera  " . $where_ . " f.estado=1 and auf.estado=1 ";

$dataFacturas = $facturas->getallFacturas($where, $_REQUEST['page'], $campos);

$auMedica = new auMedica($conexion['local']);
include '../requestFunctionsJavascript.php';
?>

<?php
$AlarmaDevolucion = $auMedica->getAllFacturasConAuditoriaFinancieraConAntiguedadXDias();
if (count($AlarmaDevolucion) > 0) {
    ?>
    <div class="alert alert-info" style="padding: 20px;margin: 11px;">

        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <strong>Han pasado 20 dias y no se ha hecho auditoria medica a las facturas: </strong>

        <?php
        // var_dump($AlarmaDevolucion);
        foreach ($AlarmaDevolucion as $key => $ad) {
            ?>
            <div class="links-sin-devoluciones">
                <a class="addAuditoriaMedica link-<?php echo $ad['idFactura'] ?>" data-record="<?php echo $ad['idFactura'] ?>" data-section="factura" data-action="factura" class=""><?php echo ($key + 1); ?>. Auditoria financiera realizada el <?php echo $ad['fecha_auditoria'] ?> para la Factura N° <?php echo $ad['numero_factura'] ?></a>
            </div>

            <?php
        }
        ?>
    </div>
    <?php
}



$AlarmaGlosaInicial = $auMedica->getAllFacturasConGlosaInicialConAntiguedadXDias();
if (count($AlarmaGlosaInicial) > 0) {
    ?>
    <div class="alert alert-success" style="padding: 20px;margin: 11px;">

        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <strong>Han pasado 10 dias y hay glosas iniciales pendientes: </strong>

        <?php
        // var_dump($AlarmaDevolucion);
        foreach ($AlarmaGlosaInicial as $key => $ad) {
            ?>
            <div class="links-sin-devoluciones">
                <a class="agregarNuevaGlosa link-<?php echo $ad['idFactura'] ?>"  role="button" data-auditoria='<?php echo $ad['idauditoria_medica']; ?>' data-toggle="modal" href="#agregarNuevaGlosa" data-record="<? echo $ad['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><?php echo ($key + 1); ?>. Auditoria Medica con glosa inicial realizada el <?php echo $ad['glosa_fecha_glosa'] ?> para la Factura N° <?php echo $ad['numero_factura'] ?></a>
            </div>

            <?php
        }
        ?>
    </div>
    <?php
}

$AlarmaGlosa1 = $auMedica->getAllFacturasConGlosaPrimeraConAntiguedadXDias();
if (count($AlarmaGlosa1) > 0) {
    ?>
    <div class="alert alert-danger" style="padding: 20px;margin: 11px;">

        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <strong>Han pasado 7 dias y hay glosas con primera respuesta pendientes: </strong>

        <?php
        // var_dump($AlarmaDevolucion);
        foreach ($AlarmaGlosa1 as $key => $ad) {
            ?>
            <div class="links-sin-devoluciones">
                <a class="agregarNuevaGlosa link-<?php echo $ad['idFactura'] ?>"  role="button" data-auditoria='<?php echo $ad['idauditoria_medica']; ?>' data-toggle="modal" href="#agregarNuevaGlosa" data-record="<? echo $ad['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><?php echo ($key + 1); ?>. Auditoria Medica con glosa inicial realizada el <?php echo $ad['glosa_fecha_glosa_1'] ?> para la Factura N° <?php echo $ad['numero_factura'] ?></a>
            </div>

            <?php
        }
        ?>
    </div>
    <?php
}
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="ID" >
            <button type="submit" class="btn btn-primary search-btn-2" <? echo $_REQUEST['section'] ?> data-case="auditoria_medica"> <i class="icon-search icon-white"></i></button>
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

        <div class="clear"></div>


    </div>
    <input type="hidden" id="nombre_archivo" value="/auditoria_medica/index_factura" />


    <div id="contenido">

        <table  id="reporte" class="responsive table table-hover">
            <thead>

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
                <?
                $i = 1;
                foreach ($dataFacturas['data'] as $fac) {

                    //   echo '<pre>'; var_dump($fac); echo '</pre>';
                    $rs_au = $auMedica->getOne(0, $fac['idFactura']);
                    //var_dump($rs_au);
                    $isGlosa = ($rs_au['estado_factura'] == '2') ? true : false;
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
                            <?= ($fac['audFinanciera'] > 0) ? '<strong class="label label-info">OK</strong>' : '<strong class="label label-warning">Pendiente</strong>' ?>
                        </td>
                        <? if (empty($rs_au)): ?>
                            <td width="61">
                                <a>
                                    <span class="addAuditoriaMedica" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-success"><i class=" icon-plus"></i></button></span>
                                </a>
                            </td>
                        <? else: ?>
                            <td width="160">

                                <button class="btn btn-primary verAuditoriaMedica" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class="icon-check"></i></button>

                                <?php if ($isGlosa) {
                                    ?>
                                    <button class="btn btn-warning agregarNuevaGlosa" role="button" data-auditoria='<?php echo $rs_au['idauditoria_medica']; ?>' data-toggle="modal" href="#agregarNuevaGlosa" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class=" icon-medkit"></i></button>
                                    <button class="btn btn-success verGlosasAgregadas" role="button" data-auditoria='<?php echo $rs_au['idauditoria_medica']; ?>' data-toggle="modal" href="#verGlosa" data-record="<? echo $fac['idFactura']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><i class=" icon-inbox"></i></button>
                                <?php }
                                ?>
                                <span class="anularRegistro" data-type="auditoria_medica" data-idregistro="<?php echo $rs_au['idauditoria_medica'] ?>" data-record="<? echo $fac['idf']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> data-auditor="<? echo $rs_au['idauditoria_medica'] ?>" <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?> title="Anular auditoria"><button class="btn btn-danger"><i class=" icon-remove"></i></button></span>

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
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_medica/js/factura.js"></script>
</div>

<script>
    var page_total = <?php echo ($dataFacturas['total'] > 1) ? $dataFacturas['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['action'] ?>');
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.agregarNuevaGlosa').click(function() {
            
            $('.guardarNuevaGlosa').attr('data-record', $(this).attr('data-record'))
            $('.auditoria_glosa').val($(this).attr('data-auditoria'));

            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/nuevaGlosa.php', {idauditoria_medica: $(this).attr('data-auditoria'), idFactura: $(this).attr('data-record')}, function(data){
                $('.modal-add-glosa').html(data);
            })
            
        })
        
        

        $('.verGlosasAgregadas').click(function() {
            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/consultaGlosas.php', {auditoria_glosa: $(this).attr('data-auditoria'), id: $(this).attr('data-record')}, function(data) {
                $('#verGlosa .modal-body').html(data);
            })
        })



    })
</script>
<!-- Modal -->
<div id="verGlosa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Historial de Glosas</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!-- Modal -->
<div id="agregarNuevaGlosa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Agregar Nueva Glosa</h3>
    </div>
    <div class="modal-body modal-add-glosa" style="max-height: 482px;">


    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary guardarNuevaGlosa" data-record="">guardar</button>
    </div>
</div>




<div aria-hidden="true" aria-labelledby="myModalLabel2" role="dialog" tabindex="-1" class="modal hide fade" id="myModal2" style="display: none;">
    <div class="modal-header modal-danger">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
        <h3 id="myModalLabel2">Alert Header</h3>
    </div>
    <div class="modal-body links-sin-auditar">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum excepturi nulla aut fugit iste tempore nihil. Nemo ut ipsum non consequatur nulla similique possimus ea minima. Facilis quibusdam cumque itaque!</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">OK</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.getJSON(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/loadAlarms', {}, function(data) {
            $.each(data, function(i, j) {
                console.log(j);
                //$('.links-sin-auditar').append();
            })

            $('#myModal2').modal('show');
        })
       
    })

</script>