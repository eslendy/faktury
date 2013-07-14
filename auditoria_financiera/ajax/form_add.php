<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../../radicacion/clases/facturas_class.php");
include("../../radicacion/clases/contrato_class.php");
include("../../usuarios/clases/usuarios_class.php");
//include("../clases/auditoria_financiera.php");
$factura = new facturas($conexion['local']);
//usuarios
$usuarios = new usuarios($conexion['local']);
//se obtiene la informacion de la factura a auditar
$data = $factura->getFactura($_GET['idfactura']);
$contrato = new contrato($conexion['local']);
$contrat=$contrato->getOne($data['contrato']);
//print_r($data);
?>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME ?>auditoria_financiera/index_factura.php" />
<div id="contenido" class="dividido">
<div class="partes">
    <fieldset>
        <legend>Auditoría Financiera</legend>
        <form id="addAuditoria">
            <input type="hidden" name="idFactura" id="idFactura" value="<?=$_GET['idfactura']?>" />
            <input type="hidden" name="idusuario" id="idusuario" value="<?=$_SESSION['usrid']?>" />
            <table width="100%">
                <tbody>
                    
                    <tr>
                        <td><label>Auditor Médico</label><br />
                            <?=$usuarios->_combo("id_auditor","id_auditor","","p.idperfil=4")?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Observaciones de Auditoría</label><br />
                        <textarea name="concepto_auditoria" id="concepto_auditoria" rows="15" style="width:100%;" class="validate[required,custom[TextoEspecial]]"></textarea></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <table width="100%">
            <tbody>
                <tr>
                    <td align="right">
                        <button class="guardarDaata btn btn-primary">
                            Guardar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>

</div>
<div class="partes">
	<div id="acordeon">
        <h3>Información de la Factura</h3>
        <div>
            <table align="center">
            	<tbody>
                	<tr>
                    	<td width="70%"><label>No. Radicado</label></td>
                        <td align="right"><?=$data['no_radicado']?></td>
                    </tr>
                    <tr>
                    	<td><label>No. Factura</label></td>
                        <td align="right"><?=(($data['prefijo']!="")?$data['prefijo'].' ':'').$data['numero_factura']?></td>
                    </tr>
                    <tr>
                    	<td><label>Fecha de emisión Factura</label></td>
                        <td align="right"><?=$data['fecha_emision']?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Presentación</label></td>
                        <td align="right"><?=$data['fecha_radicacion']?></td>
                    </tr>
                    <tr>
                    	<td><label>Valor de la Factura</label></td>
                        <td align="right">$<?=number_format($data['valor'],2);?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Proveedor</legend>
                                <table width="100%">
                                    <tr>
                                        <td><label>Nombre</label></td>
                                        <td align="right"><?=$data['proveedor_nombre']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>No. Documento</label></td>
                                        <td align="right"><?=$data['doc_proveedor']?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <? if($contrat['numero_contrato']!='RG'):?>
                        <td colspan="2">
                            <fieldset>
                                <legend>Contrato</legend>
                                <table width="100%">
                                    <tr>
                                        <td><label>No. Contrato</label></td>
                                        <td align="right"><?=$contrat['numero_contrato']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Fecha Inicio del Contrato</label></td>
                                        <td align="right"><?=$contrat['fecha_contrato']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Valor Contrato</label></td>
                                        <td align="right">$<?=number_format($contrat['valor_contrato'],2)?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        <td>
                        <? else:?>
                        <td><label>Tipo</label></td>
                        <td align="right"><?=$contrat['numero_contrato']?></td>
                        <? endif;?>
                    </tr>
                    <tr>
                    	<td><label>Unidad de Atención GAVD-CENAF</label></td>
                        <td align="right"><?=$data['Uatencion']?></td>
                    </tr>
                    <tr>
                        <td><label>Unidad de Atención GAVD-CENAF Centralizada</label></td>
                        <td align="right"><?=$data['UatencionC']?></td>
                    </tr>
                    <tr>
                        <td><label>Unidad de Atención GAVD-CENAF Centralizadora</label></td>
                        <td align="right"><?=$data['UatencionCe']?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Paciente</legend>
                                <table width="100%">
                                    <tr>
                                        <td><label>Nombre</label></td>
                                        <td align="right"><?=$data['paciente_nombre']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>No. Documento</label></td>
                                        <td align="right"><?=$data['doc_paciente']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Unidad del Paciente</label></td>
                                        <td align="right"><?=$data['Upaciente']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Grado</label></td>
                                        <td align="right"><?=$data['grado']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Fuerza</label></td>
                                        <td align="right"><?=$data['fuerza']?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Parentesco</label></td>
                                        <td align="right"><?=$data['desc_parentesco']?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    
                    <tr>
                    	<td><label>Número Autorización</label></td>
                        <td align="right"><?=$data['no_autorizacion']?></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Autorización del Servicio</label></td>
                        <td align="right"><?=$data['fecha_autorizacion_servicio']?></td>
                    </tr>
                    <tr>
                    	<td><label>Fecha Ingreso del Paciente</label></td>
                        <td align="right"><?=$data['fecha_ingreso_paciente']?></td>
                    </tr>
                    <tr>
                    	<td><label>Fecha Salida del Paciente</label></td>
                        <td align="right"><?=$data['fecha_egreso_paciente']?></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td align="right"><?=(($data['estado_factura']==1)?'En proceso':'Paga')?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3>Auditoría Médica</h3>
        <div></div>
    </div>
</div>
</div>
<script>
	$(function(){
		_botonesIcons('.guardarDaata',"ui-icon-disk","",function(){
			_guardarMods("addAuditoria","#addAuditoria", "Auditoría");
		});
        $("#acordeon").accordion({
          collapsible: true,
          active : false,
          heightStyle: "content"
        });
	});
</script>