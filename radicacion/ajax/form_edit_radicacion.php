<?php
require_once('../../vigiaAjax.php');
require_once('../../libphp/config.inc.php');
require_once('../../libphp/mysql.php');
require_once('../clases/udAtencion_class.php');
require_once('../clases/grados_class.php');
require_once('../clases/fuerza_class.php');
require_once('../clases/tipodoc_class.php');
require_once('../clases/paciente_class.php');
require_once('../clases/proveedor_class.php');
require_once('../clases/unidades_class.php');
require_once('../clases/facturas_class.php');
require_once('../clases/contrato_class.php');
require_once('../clases/parentesco_class.php');

switch ($_REQUEST['case']) {
    case 'factura':
        $factura = new facturas($conexion['local']);
        $contrato = new contrato($conexion['local']);

        $data = $factura->getFactura($_POST['id']);
        ?>

        <form id="frmfactura" class="formulario">
            <input type="hidden" name="idFactura" id="idFactura" value="<?= $data['idf'] ?>" />
            <table class="responsive table">



                <tbody>
                    <tr>
                        <td width="70%">
                            <label>Mes de Radicado</label>
                        </td>
                        <td>
                         <select name="mes_radicado" class="">
                                <?php
                                $mesrad = $data['mes_radicado'];
                                $rango = 12;
                                for ($i = 1; $i <= $rango; $i++) {
                                    $mesano = date('Y-n', mktime(0, 0, 0, $i, 1, date("Y")));
                                    $meses = date('F', mktime(0, 0, 0, $i, 1, date("Y")));
                                    $ano = date('Y', mktime(0, 0, 0, $i, 1, date("Y")));

                                    if ($meses == "January")
                                        $meses = "Enero";
                                    if ($meses == "February")
                                        $meses = "Febrero";
                                    if ($meses == "March")
                                        $meses = "Marzo";
                                    if ($meses == "April")
                                        $meses = "Abril";
                                    if ($meses == "May")
                                        $meses = "Mayo";
                                    if ($meses == "June")
                                        $meses = "Junio";
                                    if ($meses == "July")
                                        $meses = "Julio";
                                    if ($meses == "August")
                                        $meses = "Agosto";
                                    if ($meses == "September")
                                        $meses = "Septiembre";
                                    if ($meses == "October")
                                        $meses = "Octubre";
                                    if ($meses == "November")
                                        $meses = "Noviembre";
                                    if ($meses == "December")
                                        $meses = "Diciembre";
                                    if($mesrad == $i){
                                        echo "<option value='$i' selected>$meses</option>";
                                    }
                                    else{
                                         echo "<option value='$i'>$meses</option>";
                                    }
                                    
                                }
                                ?> 
                            </select> 
                        </td>       

                    </tr>

                    <tr>
                        <td ><label>Número Radicado</label></td>
                        <td>
                            <input type="text" name="no_radicado" id="no_radicado" class="validate[required,custom[numberP]]" value="<?= $data['no_radicado'] ?>" />
                        </td>
                    </tr>
                   
                    <tr>
                        <td><label>Número Factura</label></td>
                        <td>
                            <input type="text" name="numero_factura" id="numero_factura" class="validate[required,custom[onlyNumberSp]]" value="<?= $data['numero_factura'] ?>" />
                        </td>
                    </tr>
                     <tr>
                        <td><label>Prefijo Fatura</label></td>
                        <td><input type="text" name="prefijo" id="prefijo" class="validate[custom[onlyLetterNumber]]" value="<?= $data['prefijo'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de emisión Factura</label></td>
                        <td><input type="text" name="fecha_emision" id="fecha_emision" class="fecha validate[required,custom[date2]]" value="<?= $data['fecha_emision'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Valor de la Factura</label></td>
                        <td><input type="number" name="valor" id="valor" class="validate[required,custom[numberP]] pesos"  value="<?= $data['valor'] ?>" /></td>
                    </tr>
                       <tr>
                        <td>
                            <label class="pull-left">Fecha de presentacion Factura</label>
                            </td>
                            
                        <td>
                            <input type="text" name="fecha_presentacion" id="fecha_presentacion" class="pull-left fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5" value="<?= $data['fecha_presentacion'] ?>"/>

                        </td>
                    </tr>
                    <tr>
                        <td><label>Proveedor</label></td>
                        <td>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['proveedor_nombre'] ?>" />
                            <input type="hidden" id="idproveedor" name="idproveedor" class="validate[required]" value="<?= $data['idproveedor'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Contrato</label></td>
                        <td id="td_contrato">
                            <?= $contrato->_select("c.idproveedor=" . $data['idproveedor'], "contrato", "contrato", $data['contrato']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Unidad de Atención GAVD-CENAF</label></td>
                        <td>
                            <input type="text" id="autoc-idunidad_atencion" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['Uatencion'] ?>" />
                            <input type="hidden" id="idunidad_atencion" name="idunidad_atencion" value="<?= $data['idunidad_at'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Unidad Centralizada</label></td>
                        <td>
                            <input type="text" id="autoc-idcentralizada" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt"  value="<?= $data['UatencionC'] ?>" />
                            <input type="hidden" id="idcentralizada" name="idcentralizada" value="<?= $data['idcentralizada'] ?>" class="validate[required]" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Unidad Centralizadora</label></td>
                        <td>
                            <input type="text" id="autoc-idcentralizadora" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt"  value="<?= $data['UatencionCe'] ?>" />
                            <input type="hidden" id="idcentralizadora" name="idcentralizadora" value="<?= $data['idcentralizadora'] ?>" class="validate[required]" />
                        </td>
                    </tr>

                    <tr>
                        <td><label>Paciente</label></td>
                        <td>
                            <input type="text" id="autoc-idpaciente" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['paciente_nombre'] ?>" />
                            <input type="hidden" id="idpaciente" name="idpaciente" value="<?= $data['idpaciente'] ?>" />
                            <input type="hidden" id="idunidad" name="idunidad" value="1" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Unidad del Paciente</label></td>
                        <td>
                             <input type="radio" name="idparentesco" id="idparentescoT" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['idparentesco'] == 1) ? 'checked="checked"' : '' ?>/> <span class="text-title">Titular </span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoB" value="2" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['idparentesco'] == 2) ? 'checked="checked"' : '' ?>/> <span class="text-title">Beneficiario</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoR" value="3" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['idparentesco'] == 3) ? 'checked="checked"' : '' ?>/> <span class="text-title">Retirado</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoP" value="4" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['idparentesco'] == 4) ? 'checked="checked"' : '' ?>/> <span class="text-title">Pensionado</span>

                          </td>
                    </tr>
                   <? /* <tr>
                        <td><label>Unidad del Paciente</label></td>
                        <td>
                            <input type="text" id="autoc-idunidad" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['Upaciente'] ?>" />
                            <input type="hidden" id="idunidad" name="idunidad" value="<?= $data['idunidad'] ?>" />
                        </td>
                    </tr>*/ ?>
                    <tr>
                        <td><label>Grado del Paciente</label></td>
                        <td>
                            <input type="text" id="autoc-idgrado" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['grado'] ?>" />
                            <input type="hidden" id="idgrado" name="idgrado" class="validate[required]" value="<?= $data['idgrado'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Número Autorización</label></td>
                        <td>
                            <input type="text" name="no_autorizacion" id="no_autorizacion" class="validate[required,custom[onlyNumberSp]]" value="<?= $data['no_autorizacion'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Fecha Autorización del Servicio</label></td>
                        <td>
                            <input type="text" name="fecha_autorizacion_servicio" id="fecha_autorizacion_servicio" class="fecha validate[required,custom[onlyLetterNumber]]" value="<?= $data['fecha_autorizacion_servicio'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Fecha Ingreso del Paciente</label></td>
                        <td>
                            <input type="text" name="fecha_ingreso_paciente" id="fecha_ingreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" value="<?= $data['fecha_ingreso_paciente'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Fecha Salida del Paciente</label></td>
                        <td>
                            <input type="text" name="fecha_egreso_paciente" id="fecha_egreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" value="<?= $data['fecha_egreso_paciente'] ?>" />
                        </td>
                    </tr>
                    <tr>

                        <td colspan="2"><label>Estado</label>

                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado_factura'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">En Proceso</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado_factura'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Paga</span>

                        </td>

                    </tr>
                </tbody>
            </table>
        </form>

        <?php
        break;
    case 'unidadAtencion':
        $unds = new undidad_atencion($conexion['local']);
        $dataUnds = $unds->getUnidad($_POST['id']);
        ?>
        <form id="frmunidadAtencion" class="formulario">
            <input type="hidden" name="idunidad_atencion" id="idunidad_atencion" value="<?= $dataUnds['idunidad_atencion'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?= $dataUnds['descripcion'] ?>" /></td>
                    </tr>
                    <tr>
                        <td>Und. Centralizadora</td>
                        <td>
                            <select id="centralizada" name="centralizada">
                                <option value="0" <?= (($dataUnds['centralizada'] == 0) ? 'selected="selected"' : '') ?>>NO</option>
                                <option value="1" <?= (($dataUnds['centralizada'] == 1) ? 'selected="selected"' : '') ?>>SI</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($dataUnds['estado'] == 1) ? 'checked="checked"' : '' ?>/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($dataUnds['estado'] == 0) ? 'checked="checked"' : '' ?>/> <span class="text-title">Inactivo</span>

                       

                        </td>

                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'contrato':
        $contrato = new contrato($conexion['local']);
        $data = $contrato->getOne($_POST['id']);
        ?>
        <form id="frmcontrato" class="formulario">
            <input type="hidden" name="idcontrato" id="idcontrato" class="validate[required]" value="<?= $data['idcontrato'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Número de contrato</label></td>
                        <td><input type="number" name="numero_contrato" id="numero_contrato" class="validate[required,custom[onlyLetterNumber]]" value="<?= $data['numero_contrato'] ?>"/></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de Inicio del Contrato</label></td>
                        <td><input type="text" name="fecha_contrato" id="fecha_contrato" class="validate[required,custom[TextoAcentosNum]] fecha" value="<?= $data['fecha_contrato'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Valor</label></td>
                        <td><input type="number" name="valor_contrato" id="valor_contrato" class="validate[required,custom[numberP]] pesos" value="<?= $data['valor_contrato'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Proveedor</label></td>
                        <td>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" value="<?= $data['proveedor'] ?>" />
                            <input type="hidden" name="idproveedor" id="idproveedor" class="validate[required]" value="<?= $data['idproveedor'] ?>" />
                        </td>
                    </tr>
                    <tr>

                        <td  colspan="2">
                            <label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoContrato'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoContrato'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>

                        </td>
                        

                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case'grados':
        $obj = new grados($conexion['local']);
        $data = $obj->getGrado($_POST['id']);
        ?>
        <form id="frmgrados" class="formulario">
            <input type="hidden" name="idgrado" id="idgrado" value="<?= $data['idgrado'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?= $data['descripcion'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" value="<?= $data['abreviatura'] ?>" /></td>
                    </tr>
                    <tr>
                        <td  colspan="2"> <label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado'] == 1) ? 'checked="checked"' : '' ?> /><span class="text-title"> Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado'] == 0) ? 'checked="checked"' : '' ?> /><span class="text-title"> Inactivo</span>

                        </td>
                        


                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case'fuerza':
        $obj = new fuerza($conexion['local']);
        $data = $obj->getFuerza($_POST['id']);
        ?>
        <form id="frmfuerza" class="formulario">
            <input type="hidden" name="idfuerza" id="idfuerza" value="<?= $data['idfuerza'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?= $data['descripcion'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" value="<?= $data['abreviatura'] ?>" /></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"  <?= ($data['estado'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>

                        </td>
                       

                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'pacientes':

        $tipo_doc = new tipodoc($conexion['local']);
        $fuerza = new fuerza($conexion['local']);
        $paciente = new paciente($conexion['local']);
        $data = $paciente->getOne($_POST['id']);
        ?>
        <form id="frmpacientes" class="formulario">
            <input type="hidden" name="idpaciente" id="idpaciente" value="<?= $data['idpaciente'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required]", $data['idtipo_doc']); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td><input type="text" name="documento" id="documento" class="validate[required,custom[onlyLetterNumber]]" value="<?= $data['documento'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[soloTextoAcentos]]" value="<?= $data['nombre'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Apellido</label></td>
                        <td><input type="text" name="apellidos" id="apellidos" class="validate[required,custom[soloTextoAcentos]]" value="<?= $data['apellidos'] ?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Fuerza</label></td>
                        <td><?= $fuerza->combobox("idfuerza", "idfuerza", "validate[required]", $data['idfuerza']); ?></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoPaciente'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoPaciente'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>
                        </td>
                       
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'proveedor':
        $tipo_doc = new tipodoc($conexion['local']);
        $proveedor = new proveedor($conexion['local']);
        $data = $proveedor->getOne($_POST['id']);
        ?>
        <form id="frmproveedor" class="formulario">
            <input type="hidden" name="idproveedor" id="idproveedor" value="<?= $data['idproveedor'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required] documento", $data['idtipo_doc']); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td>
                            <input type="text" name="nodocumento" id="nodocumento" style="width: 136px" class="validate[required,custom[numberP]]" value="<?= $data['nodocumento'] ?>" />
                            <input type="text" size="3" id="dv"  class="validate[custom[numberP]]"  style="width: 50px" name="dv" <?= ($data['idtipo_doc'] != 2) ? 'style="display:none;"' : '' ?> placeholder="DV" value="<?= $data['dv'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre Proveedor</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[TextoAcentosNum]]" value="<?= $data['nombre'] ?>" /></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoProveedor'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estadoProveedor'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>
                        </td>
                       

                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>
        <?php
        break;
    case 'unidades':
        $unds = new undidad($conexion['local']);
        $dataUnds = $unds->getOne($_POST['id']);
        ?>
        <form id="frmunidad" class="formulario">
            <input type="hidden" name="idunidad" id="idunidad" value="<?= $dataUnds['idunidad'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?= $dataUnds['descripcion'] ?>" /></td>
                    </tr>
                    <tr>

                        <td  colspan="2"><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($dataUnds['estado'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($dataUnds['estado'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>

                        </td>
                       

                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'parentesco':
        $paren = new parentesco($conexion['local']);
        $data = $paren->getOne($_POST['id']);
        ?>
        <form id="frmparentesco" class="formulario">
            <input type="hidden" name="idparentesco" id="idparentesco" value="<?= $data['idparentesco'] ?>" />
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?= $data['descripcion'] ?>" /></td>
                    </tr>
                    <tr>

                        <td  colspan="2"><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"  <?= ($data['estado'] == 1) ? 'checked="checked"' : '' ?> /> <span class="text-title">Activo</span>
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5" <?= ($data['estado'] == 0) ? 'checked="checked"' : '' ?> /> <span class="text-title">Inactivo</span>

                        </td>
                       
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
}
?>

<script>
    $('.guardar-formulario').submit(function(e) {
        $.preventDefault(e);

    })
    $('.guardar-formulario').click(function(e) {

        console.log('das')
        
        if ($('#frm<? echo $_REQUEST['case'] ?>').validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/save.php?type=edit<? echo $_REQUEST['case'] ?>', $('#frm<? echo $_REQUEST['case'] ?>').serialize(), function(data) {
                console.log('entra: ' + data);
                switch (data) {
                    case '1':
                        alert("<? echo $_REQUEST['case'] ?> Editado con Éxito!!");
                        $("#dialog-addModRad").remove();
                        _loadContenido($('#nombre_archivo').val());
                          $('.modal').modal('hide')
                        break;
                    default:
                        _msgerror(data, "#mensaje");
                        break;
                }
            })
        }

    })
    nuevo_reg_load();
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue',
            increaseArea: '-10' // optionaliradio_flat-red
        });
    });
     $(function() {
        $( ".fecha" ).datepicker({
            showOn: "button",
            buttonImage: "/imagenes/calendar.gif",
            buttonImageOnly: true,
            dateFormat: "yy-mm-dd" 
        });
    });
</script>