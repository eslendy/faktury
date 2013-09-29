<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("../radicacion/clases/facturas_class.php");
include("clases/auMedica_class.php");
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
            $('.auditoria_glosa').val($(this).attr('data-auditoria'));
        })
        _autocompletar("#autoc-idglosa2", init.XNG_WEBSITE_URL + "auditoria_medica/ajax/busqueda.php?case=glosas&tipo=-1", function(ui) {
            $("#idglosa2").val(ui.item.id);
        }, function(ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.icon + "</a>")
                    .appendTo(ul);
        })


        _autocompletar("#autoc-idglosa3", init.XNG_WEBSITE_URL + "auditoria_medica/ajax/busqueda.php?case=glosas&tipo=-1", function(ui) {
            $("#idglosa3").val(ui.item.id);
        }, function(ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.icon + "</a>")
                    .appendTo(ul);
        })


        _autocompletar("#autoc-idglosa4", init.XNG_WEBSITE_URL + "auditoria_medica/ajax/busqueda.php?case=glosas&tipo=-1", function(ui) {
            $("#idglosa4").val(ui.item.id);
        }, function(ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.icon + "</a>")
                    .appendTo(ul);
        })

        $('.verGlosasAgregadas').click(function() {
            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/consultaGlosas.php', {auditoria_glosa: $(this).attr('data-auditoria'), id: $(this).attr('data-record')}, function(data) {
                $('#verGlosa .modal-body').html(data);
            })
        })
        $('.guardarNuevaGlosa').click(function() {
            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/save.php?type=addNewGlosa', $('.addOtherGlosa').serialize(), function(data) {
                alert('Se ha agregado una nueva glosa para esta auditoria.')
                $('#agregarNuevaGlosa').modal('hide');
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
    <div class="modal-body" style="max-height: 482px;">
        <form class='addOtherGlosa' method="post" >


            <input type="hidden" value="" name='auditoria_glosa' class='auditoria_glosa' />
            <fieldset>
                <table width="100%" class="responsive">
                    <tbody>
                        <tr>
                            <td width="200">Tipo Glosa</td>
                            <td>
                                <?php
                                $LastGlosa = $auMedica->getLastGlosaByIdAuditoria($rs_au['idauditoria_medica']);
                                //var_dump($LastGlosa);
                                if (isset($LastGlosa)) {
                                    $LastGlosa = $LastGlosa;
                                } else {
                                    $LastGlosa['step_glosa'] = 0;
                                }
                                //echo $LastGlosa['step_glosa'];
                                ?>

                                <select name="step_glosa" class="step_glosa" size="3" multiple>
                                    <option class="option-glosa" value="1" <?php echo ($LastGlosa['step_glosa'] == 0) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 0) ? ' disabled="true" style="color:#D1D1D1;"' : ''; ?>>Primera respuesta de Glosa</option>
                                    <option class="option-glosa" value="2" <?php echo ($LastGlosa['step_glosa'] > 0) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 1) ? ' disabled="true" style="color:#D1D1D1;"' : ''; ?>>Segunda respuesta de Glosa</option>
                                    <option class="option-glosa" value="3" <?php echo ($LastGlosa['step_glosa'] > 1) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 2) ? 'selected="selected" disabled="true" style="color:#D1D1D1;"' : ''; ?>>Glosa de conciliacion</option>
                                </select>
                            </td>
                        </tr>





                        <tr  <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Codigo Glosa</td>
                            <td>
                                <input type="text" id="autoc-idglosa2" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                                <input type="hidden" name="glosa_idglosa_1" id="idglosa2" class="validate[custom[numberP]]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_glosa_1"  class="fecha validate[custom[date2]]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha Recepcion de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_recepcion_glosa_1"  class="fecha validate[]" />
                            </td>
                        </tr>

                        <tr <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Valor aceptado por la IPS</td>
                            <td>
                                <input type="number" name="glosa_valor_aceptado_ips_1" id="valor_glosa-chk_2" class=" pesos" />
                                <button class="btn btn-success AddNewValueGlosa" data-related=".valor_ips"><i class="icon-plus"></i></button>

                            </td>
                        </tr>

                        <tr <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Valor levantado</td>
                            <td>
                                <input type="number" name="glosa_valor_glosa_levantado_1" id="valor_glosa-chk_2" class=" pesos" />
                                <button class="btn btn-success AddNewValueGlosa" data-related=".valor_levantado"><i class="icon-plus"></i></button>
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Observaciones </td>
                            <td>
                                <textarea name="glosa_observaciones_1" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ></textarea>
                            </td>
                        </tr>







                        <tr <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Codigo Glosa</td>
                            <td>
                                <input type="text" id="autoc-idglosa3" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                                <input type="hidden" name="glosa_idglosa_2" id="idglosa3" class="validate[custom[numberP]]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_glosa_2"  class="fecha validate[custom[date2]]" />
                            </td>
                        </tr>

                        <tr <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha de recepcion de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_recepcion_glosa_2"  class="fecha validate[]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Valor de Glosa Pendiente</td>
                            <td>
                                <input type="number" name="glosa_valor_glosa_2" id="valor_glosa-chk_2" class=" pesos" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Observaciones </td>
                            <td>
                                <textarea name="glosa_observaciones_2" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ></textarea>
                            </td>
                        </tr>





                        <tr <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Codigo Glosa</td>
                            <td>
                                <input type="text" id="autoc-idglosa4" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                                <input type="hidden" name="glosa_idglosa_3" id="idglosa4" class="validate[custom[numberP]]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_glosa_3"  class="fecha validate[custom[date2]]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Fecha de recepcion de Glosa</td>
                            <td>
                                <input type="text" name="glosa_fecha_recepcion_glosa_3"  class="fecha validate[]" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Valor definitivo</td>
                            <td>
                                <input type="number" name="glosa_valor_glosa_3" id="valor_glosa-chk_2" class=" pesos" />
                            </td>
                        </tr>
                        <tr <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                            <td>Observaciones </td>
                            <td>
                                <textarea name="glosa_observaciones_3" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ></textarea>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary guardarNuevaGlosa">guardar</button>
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
    $(document).ready(function(){
        $.getJSON(init.XNG_WEBSITE_URL+'auditoria_medica/ajax/loadAlarms', {}, function(data){
            $.each(data, function(i,j){
                console.log(j);
                //$('.links-sin-auditar').append();
            })
            
            $('#myModal2').modal('show');
        })
        
    })

</script>