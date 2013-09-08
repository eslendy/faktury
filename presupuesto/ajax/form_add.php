<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
?>
<form id="frmaddPre" class='addPresupuesto' method="post" >


    <input type="hidden" value="<?php echo $_REQUEST['auditoria_id']; ?>" name='auditoria_id' class='auditoria_id' />
    <input type="hidden" value="<?php echo $_REQUEST['idFactura']; ?>" name='idFactura' class='idFactura' />
    <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION['usrid'] ?>" />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Numero CDP</td>
                    <td>
                        <input type="number" name="presupuesto_cdp" id="presupuesto_cdp" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha CDP</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_cdp"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero RPC</td>
                    <td>
                        <input type="number" name="presupuesto_rpc" id="presupuesto_rpc" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha RPC</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero de Resolucion de r. del gasto</td>
                    <td>
                        <input type="number" name="presupuesto_numero_resolucion" id="presupuesto_numero_resolucion" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>

                <tr>
                    <td>Fecha resolucion de r. del gasto</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc_gasto"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>
<button class="btn btn-primary guardarNuevoPresupuesto btn-large">Guardar Nuevo Presupuesto</button>
<div class="partes">
    <div id="acordeon">

        <?php
        $idFactura = $data['idFactura'];
        include_once ('../../radicacion/clases/facturas_class.php');
        $data = new facturas($conexion['local']);
        $data = $data->getFactura($idFactura);
        ?>

        <h3>Información de la Factura</h3>
        <div>
            <table align="center" width='100%'>
                <tbody>
                    <tr>
                        <td width="70%"><label>No. Radicado</label></td>
                        <td align="right"><?= $data['no_radicado'] ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Factura</label></td>
                        <td align="right"><?= (($data['prefijo'] != "") ? $data['prefijo'] . ' ' : '') . $data['numero_factura'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de emisión Factura</label></td>
                        <td align="right"><?= $data['fecha_emision'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Presentación</label></td>
                        <td align="right"><?= $data['fecha_radicacion'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Valor de la Factura</label></td>
                        <td align="right">$<?= number_format($data['valor'], 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Proveedor</legend>
                                <table width="100%">
                                    <tr>
                                        <td><label>Nombre</label></td>
                                        <td align="right"><?= $data['proveedor_nombre'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>No. Documento</label></td>
                                        <td align="right"><?= $data['doc_proveedor'] ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Paciente</legend>
                                <table width="100%">
                                    <tr>
                                        <td><label>Nombre</label></td>
                                        <td align="right"><?= $data['paciente_nombre'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>No. Documento</label></td>
                                        <td align="right"><?= $data['doc_paciente'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Unidad del Paciente</label></td>
                                        <? /* <td align="right"><?=$data['Upaciente']?></td> */ ?>
                                        <td align="right"><?= $data['desc_parentesco'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Grado</label></td>
                                        <td align="right"><?= $data['grado'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Fuerza</label></td>
                                        <td align="right"><?= $data['fuerza'] ?></td>
                                    </tr>
                                    <? /* <tr>
                                      <td><label>Parentesco</label></td>
                                      <td align="right"><?=$data['desc_parentesco']?></td>
                                      </tr> */ ?>

                                    <tr>
                                        <td><label>Unidad de Atención GAVD-CENAF</label></td>
                                        <td align="right"><?= $data['Uatencion'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Unidad Centralizada</label></td>
                                        <td align="right"><?= $data['UatencionC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Unidad Centralizadora</label></td>
                                        <td align="right"><?= $data['UatencionCe'] ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>



                    <tr>
                        <td><label>Número Autorización</label></td>
                        <td align="right"><?= $data['no_autorizacion'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Autorización del Servicio</label></td>
                        <td align="right"><?= $data['fecha_autorizacion_servicio'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Ingreso del Paciente</label></td>
                        <td align="right"><?= $data['fecha_ingreso_paciente'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Salida del Paciente</label></td>
                        <td align="right"><?= $data['fecha_egreso_paciente'] ?></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td align="right"><?= (($data['estado_factura'] == 1) ? 'En proceso' : 'Paga') ?></td>
                    </tr>

                    <tr>
                        <? if ($contrat['numero_contrato'] != 'RG'): ?>
                            <td colspan="2">
                                <fieldset>
                                    <legend>Contrato</legend>
                                    <table width="100%">
                                        <tr>
                                            <td><label>No. Contrato</label></td>

                                            <td align="right"><?= $contrat['numero_contrato'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Fecha Inicio del Contrato</label></td>
                                            <td align="right"><?= $contrat['fecha_contrato'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Valor Contrato</label></td>
                                            <td align="right">$<?= number_format($contrat['valor_contrato'], 2) ?></td>
                                        </tr>
                                    </table>
                                </fieldset>
                            <td>
                            <? else: ?>
                            <td><label>Tipo</label></td>
                            <td align="right"><?= $contrat['numero_contrato'] ?></td>
                        <? endif; ?>
                    </tr>

                </tbody>
            </table>
        </div>

        <h3>Auditoría Médica</h3>
        <div>

            <?php
            $idFactura = $data['idFactura'];
            include_once ('../../auditoria_medica/clases/auMedica_class.php');
            $auMedica = new auMedica($conexion['local']);
            $dataFin = $auMedica->getAuditoriaMedicabyIdFactura($idFactura);

            if ($dataFin) {
                include_once("../../radicacion/clases/contrato_class.php");
                $contrato = new contrato($conexion['local']);
                $contrato = $contrato->getOne($dataFin['contrato']);

                include_once("../../radicacion/clases/cie10_class.php");
                $cie10 = new cie10($conexion['local']);
                $idcie10 = $cie10->getOne($dataFin['idcie10']);
                ?>

                <table align="center">
                    <tr>
                        <td width="320">
                            Modalidad de Pago
                        </td>
                        <td align="right">
                            <?php echo $contrato['numero_contrato']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="320">
                            CIE 10 de la atención
                        </td>
                        <td align="right">
                            <?php echo $idcie10['codigo'] . ' - ' . $idcie10['descripcion']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Glosa Observacion</label>
                        </td>
                        <td align="right"><?php echo $dataFin['glosa_observaciones']; ?></td>
                    </tr>
                </table>

                <?php
            } else {
                echo '<em>No tiene auditoria medica</em>';
            }
            ?>
        </div>

        <h3>Presupuesto</h3>
        <div>
            <?php
            include_once ('../../presupuesto/classes/presupuesto_class.php');
            $presupuesto = new presupuesto($conexion['local']);
            $dataFin = $presupuesto->getPresupuestoByFactura($idFactura);
            ?>

            <?php if ($dataFin) { ?>
                <table align="center">
                    <tr>
                        <td width="320">
                            <label>Presupuesto CDP</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_cdp']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <label>Fecha del Presupuesto CDP</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_fecha_cdp']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <label>Numero de RCP</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_rpc']; ?></td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Fecha RCP</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_fecha_rpc']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <label>Numero de Resolucion de r. del gasto</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_numero_resolucion']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <label>Fecha resolucion de r. del gasto</label>
                        </td>
                        <td align="right"><?php echo $dataFin['presupuesto_fecha_rpc_gasto']; ?></td>
                    </tr>

                </table>
                <?php
            } else {
                echo '<em>No tiene presupuesto</em>';
            }
            ?>

        </div>


        <h3>Contabilidad</h3>
        <div>
            <?php
            include_once ('../../contabilidad/classes/contabilidad_class.php');
            $contabilidad = new contabilidad($conexion['local']);
            $dataFin = $contabilidad->getContabilidadByFactura($idFactura);
            ?>

            <?php if ($dataFin) { ?>
                <table align="center">
                    <tr>
                        <td width="320">
                            <label>Numero Obligacion</label>
                        </td>
                        <td align="right"><?php echo $dataFin['no_obligacion']; ?></td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Fecha Obligacion</label>
                        </td>
                        <td align="right"><?php echo $dataFin['fecha_obligacion']; ?></td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Tarifa contratada</label>
                        </td>
                        <td align="right"><?php echo $dataFin['tarifa_contratada']; ?></td>
                    </tr>

                </table>
                <?
            } else {
                echo '<em>No tiene contabilidad</em>';
            }
            ?>

        </div>

        <h3>Tesoreria</h3>
        <div>
            <?php
            include_once ('../../tesoreria/classes/tesoreria_class.php');
            $tesoreria = new tesoreria($conexion['local']);
            $dataFin = $tesoreria->getTesoreriaByFactura($idFactura);
            ?>

            <?php if ($dataFin) { ?>
                <table align="center">
                    <tr>
                        <td width="320">
                            <label>Número trámite interno de pago</label>
                        </td>
                        <td align="right"><?php echo $dataFin['no_tramite_pago']; ?></td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Fecha del trámite interno de pago</label>
                        </td>
                        <td align="right"><?php echo $dataFin['fecha_tramite_pago']; ?></td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Número orden de pago</label>
                        </td>
                        <td align="right"><?php echo $dataFin['no_orden_pago']; ?></td>
                    </tr>
                    <tr>
                        <td width="320">
                            <label>Fecha orden de pago</label>
                        </td>
                        <td align="right"><?php echo $dataFin['fecha_orden_pago']; ?></td>
                    </tr>

                </table>
                <?
            } else {
                echo '<em>No tiene tesoreria</em>';
            }
            ?>

        </div>


    </div>
</div>

<script>
    $(function() {
        $("#acordeon").accordion({
            collapsible: true,
            active: false,
            heightStyle: "content"
        });
    })
</script>

<script>
    $('.guardarNuevoPresupuesto').click(function() {
        if ($("#frmaddPre").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/save.php?type=addPresupuesto', $('.addPresupuesto').serialize(), function(data) {
                console.log(data);
                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Presupuesto agregado.');
                    $('#content_').collapse('show');
                }
            })
        }
    })

    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
</script>