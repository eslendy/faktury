<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../../radicacion/clases/glosas_class.php");
include("../clases/auMedica_class.php");
$auMedica = new auMedica($conexion['local']);

$fac['idFactura'] = $_REQUEST['idFactura'];
$rs_au['idauditoria_medica'] = $_REQUEST['idauditoria_medica'];
?>
<form class='addOtherGlosa' method="post" >


    <input type="hidden" value="<? echo $rs_au['idauditoria_medica'] ?>" name='auditoria_glosa' class='auditoria_glosa' />
    <fieldset>
        <table width="100%" class="responsive">
            <tbody>
                <tr>
                    <td width="200">Tipo Glosa</td>
                    <td>
                        <?php
                        $LastGlosa = $auMedica->getLastGlosaByIdAuditoria($rs_au['idauditoria_medica']);
                        $glosa = new glosas_devoluciones($conexion['local']);


                        $Glosa1 = $auMedica->getLastGlosaByIdAuditoria($rs_au['idauditoria_medica'], 1);
                        if ($Glosa1) {
                            $glosas1 = $glosa->getOne($Glosa1['glosa_idglosa_1']);
                        }



                        $Glosa2 = $auMedica->getLastGlosaByIdAuditoria($rs_au['idauditoria_medica'], 2);
                        if ($Glosa2) {
                            $glosas2 = $glosa->getOne($Glosa2['glosa_idglosa_2']);
                        }

                        $Glosa3 = $auMedica->getLastGlosaByIdAuditoria($rs_au['idauditoria_medica'], 3);
                        if ($Glosa3) {
                            $glosas3 = $glosa->getOne($Glosa3['glosa_idglosa_3']);
                        }


                        
                        if (isset($LastGlosa)) {
                            $LastGlosa = $LastGlosa;
                        } else {
                            $LastGlosa['step_glosa'] = 0;
                        }
                        //echo $LastGlosa['step_glosa'];
                        ?>

                        <select name="step_glosa" class="step_glosa" size="3" multiple>
                            <option class="option-glosa" value="1" data-selected=".glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 0) ? ' style="color:#D1D1D1;"' : ''; ?>>Primera respuesta de Glosa</option>
                            <option class="option-glosa" value="2" data-selected=".glosa2_tr" <?php echo ($LastGlosa['step_glosa'] > 0) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 1) ? ' style="color:#D1D1D1;"' : ''; ?>>Segunda respuesta de Glosa</option>
                            <option class="option-glosa" value="3" data-selected=".glosa3_tr" <?php echo ($LastGlosa['step_glosa'] > 1) ? ' selected="selected" ' : ''; ?><?php echo ($LastGlosa['step_glosa'] > 2) ? 'selected="selected" style="color:#D1D1D1;"' : ''; ?>>Glosa de conciliacion</option>
                        </select>
                    </td>
                </tr>





                <tr class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Codigo Glosa</td>
                    <td>
                        <input type="text" id="autoc-idglosa2" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<? echo ($glosas1) ? $glosas1['codigo'] . '-' . $glosas1['item'] . ' ' . $glosas1['descripcion'] : ''; ?>"/>
                        <input type="hidden" name="glosa_idglosa_1" id="idglosa2" class="validate[custom[numberP]]" value="<? echo $Glosa1['glosa_idglosa_1']; ?>"/>
                    </td>
                </tr>
                <tr  class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_glosa_1" value="<? echo $Glosa1['glosa_fecha_glosa_1']; ?>" class="fecha validate[custom[date2]]" />
                    </td>
                </tr>
                <tr  class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha Recepcion de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_recepcion_glosa_1" value="<? echo $Glosa1['glosa_fecha_recepcion_glosa_1']; ?>" class="fecha validate[]" />
                    </td>
                </tr>

                <tr  class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Valor aceptado por la IPS</td>
                    <td>
                        <input type="number" name="glosa_valor_aceptado_ips_1" value="<? echo $Glosa1['glosa_valor_aceptado_ips_1']; ?>" id="valor_glosa-chk_2" class=" pesos" />
                    </td>
                </tr>

                <tr  class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Valor levantado</td>
                    <td>
                        <input type="number" name="glosa_valor_glosa_levantado_1" value="<? echo $Glosa1['glosa_valor_glosa_levantado_1']; ?>" id="valor_glosa-chk_2" class=" pesos" />
                    </td>
                </tr>
                <tr  class="glosa1_tr" <?php echo ($LastGlosa['step_glosa'] == 0) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Observaciones </td>
                    <td>
                        <textarea name="glosa_observaciones_1" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ><? echo $Glosa1['glosa_observaciones_1']; ?></textarea>
                    </td>
                </tr>







                <tr class="glosa2_tr" <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Codigo Glosa</td>
                    <td>
                        <input type="text" id="autoc-idglosa3" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<? echo ($glosas2) ? $glosas2['codigo'] . '-' . $glosas2['item'] . ' ' . $glosas2['descripcion'] : ''; ?>"/>
                        <input type="hidden" name="glosa_idglosa_2" id="idglosa3" class="validate[custom[numberP]]" value="<? echo $Glosa2['glosa_idglosa_2']; ?>"/>
                    </td>
                </tr>
                <tr class="glosa2_tr" <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_glosa_2"  class="fecha validate[custom[date2]]" value="<? echo $Glosa2['glosa_fecha_glosa_2']; ?>"/>
                    </td>
                </tr>

                <tr class="glosa2_tr" <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha de recepcion de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_recepcion_glosa_2"  class="fecha validate[]" value="<? echo $Glosa2['glosa_fecha_recepcion_glosa_2']; ?>"/>
                    </td>
                </tr>
                <?php
                $data_glosas_ = $auMedica->getAllListsGlosasByFacturaId($fac['idFactura']);
                // var_dump($data_glosas_);
                $total___ = 0;
                ?>

                <?
                foreach ($data_glosas_ as $data___) {
                    $total___ += $data___['valor'];
                }
                //echo $LastGlosa['glosa_valor_aceptado_ips_1'];
                ?>
                <tr class="glosa2_tr" <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Valor de Glosa Pendiente</td>
                    <td>
                        <input type="number" name="glosa_valor_glosa_2" id="valor_glosa-chk_2" class=" pesos" readonly="true" value="<? echo abs($total___ - $LastGlosa['glosa_valor_aceptado_ips_1'] - $LastGlosa['glosa_valor_glosa_levantado_1']); ?>"/>
                    </td>
                </tr>
                <tr class="glosa2_tr" <?php echo ($LastGlosa['step_glosa'] == 1) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Observaciones </td>
                    <td>
                        <textarea name="glosa_observaciones_2" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ><? echo $Glosa2['glosa_observaciones_2']; ?></textarea>
                    </td>
                </tr>


                <tr class="glosa3_tr" <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Codigo Glosa</td>
                    <td>
                        <input type="text" id="autoc-idglosa4" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<? echo ($glosas3) ? $glosas3['codigo'] . '-' . $glosas3['item'] . ' ' . $glosas3['descripcion'] : ''; ?>"/>
                        <input type="hidden" name="glosa_idglosa_3" id="idglosa4" class="validate[custom[numberP]]" value="<? echo $Glosa3['glosa_idglosa_3']; ?>"/>
                    </td>
                </tr>
                <tr class="glosa3_tr" <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_glosa_3"  class="fecha validate[custom[date2]]" value="<? echo $Glosa3['glosa_fecha_glosa_3']; ?>"/>
                    </td>
                </tr>
                <tr class="glosa3_tr" <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Fecha de recepcion de Glosa</td>
                    <td>
                        <input type="text" name="glosa_fecha_recepcion_glosa_3"  class="fecha validate[]" value="<? echo $Glosa3['glosa_fecha_recepcion_glosa_3']; ?>"/>
                    </td>
                </tr>
                <tr class="glosa3_tr" <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Valor definitivo</td>
                    <td>
                        <input type="number" name="glosa_valor_glosa_3" id="valor_glosa-chk_2" class=" pesos" value="<? echo $Glosa3['glosa_valor_glosa_3']; ?>"/>
                    </td>
                </tr>
                <tr class="glosa3_tr" <?php echo ($LastGlosa['step_glosa'] == 2) ? 'style="table-row"' : 'style="display:none;"'; ?>>
                    <td>Observaciones </td>
                    <td>
                        <textarea name="glosa_observaciones_3" id="observaciones-chk_2" class="validate[funcCall[_validarGlosas]]" ><? echo $Glosa3['glosa_observaciones_3']; ?></textarea>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>

<script>


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


    $('.guardarNuevaGlosa').click(function() {
        $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/save.php?type=addNewGlosa&idFactura=' + $(this).attr('data-record'), $('.addOtherGlosa').serialize(), function(data) {
            alert('Se ha agregado una nueva glosa para esta auditoria.')
            $('#agregarNuevaGlosa').modal('hide');
            window.location = init.XNG_WEBSITE_URL + 'auditoria_medica';
        })
    })
     $('.option-glosa').click(function() {
            $('.glosa1_tr').hide();
            $('.glosa2_tr').hide();
            $('.glosa3_tr').hide();
            $($(this).data('selected')).show();
        })
        $(function() {
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
});
</script>