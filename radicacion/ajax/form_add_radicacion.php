<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
switch ($_REQUEST['case']) {
    case 'factura':
        ?>
        <form id="frmRadicacion" class="formulario">
            <table class="responsive table table-striped">

                <tbody>
                    <tr>
                        <td>
                            <label>Número Radicado</label>
                            <input type="text" name="no_radicado" id="no_radicado" class="validate[required,custom[numberP]]" /></td>
                        <td>
                            <label>Prefijo Fatura</label>
                            <input type="text" name="prefijo" id="prefijo" class="validate[custom[onlyLetterNumber]]" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Número Factura</label>
                            <input type="text" name="numero_factura" id="numero_factura" class="validate[required,custom[onlyLetterNumber]]" />
                        </td>
                        <td>
                            <label>Fecha de emisión Factura</label>
                            <input type="date" name="fecha_emision" id="fecha_emision" class="fecha validate[required,custom[date2]]" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Valor de la Factura</label>
                            <input type="number" name="valor" id="valor" class="validate[required,custom[numberP]] pesos" />
                        </td>
                        <td>
                            <label>Proveedor</label>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idproveedor" name="idproveedor" class="validate[required]" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Contrato</label>
                            <div id="td_contrato"></div>
                        </td>
                        <td>
                            <label>Unidad de Atención GAVD-CENAF</label>
                            <input type="text" id="autoc-idunidad_atencion" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idunidad_atencion" name="idunidad_atencion"  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Unidad de Atención GAVD-CENAF Centralizada</label>
                            <input type="text" id="autoc-idcentralizada" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idcentralizada" name="idcentralizada"  />
                        </td>
                        <td>
                            <label>Unidad de Atención GAVD-CENAF Centralizadora</label>
                            <input type="text" id="autoc-idcentralizadora" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idcentralizadora" name="idcentralizadora"  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Paciente</label>
                            <input type="text" id="autoc-idpaciente" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idpaciente" name="idpaciente" />
                        </td>
                        <td>
                            <label>Parentesco</label>
                            <label><input type="radio" name="idparentesco" id="idparentescoT" value="1" class="validate[required]" /> Titular</label><br />
                            <label><input type="radio" name="idparentesco" id="idparentescoB" value="2" class="validate[required]" /> Beneficiario</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Unidad del Paciente</label>
                            <input type="text" id="autoc-idunidad" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idunidad" name="idunidad" />
                        </td>
                        <td><label>Grado del Paciente</label> 
                            <input type="text" id="autoc-idgrado" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" id="idgrado" name="idgrado" class="validate[required]" /></td>
                        
                    </tr>
                    <tr>
                           <td>
                            <label>Número Autorización</label>
                            <input type="text" name="no_autorizacion" id="no_autorizacion" class="validate[required,custom[onlyLetterNumber]] " />
                        </td>
                        <td><label>Fecha Autorización del Servicio</label>
                            <input type="date" name="fecha_autorizacion_servicio" id="fecha_autorizacion_servicio" class="fecha validate[required,custom[onlyLetterNumber]]" />
                        </td>
                    </tr>


                    <tr>
                     <td><label>Fecha Ingreso del Paciente</label>
                            <input type="date" name="fecha_ingreso_paciente" id="fecha_ingreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" />
                        </td>
                        <td><label>Fecha Salida del Paciente</label>
                            <input type="date" name="fecha_egreso_paciente" id="fecha_egreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <span style="display:block;"><label>En Proceso</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Paga</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                   
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>

        <?php
        break;
    case 'undAtencion':
        ?>
        <form id="frmUndAtencion" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td>Und. Centralizadora</td>
                        <td>
                            <select id="centralizada" name="centralizada">
                                <option value="0" >NO</option>
                                <option value="1" >SI</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'contrato':
        ?>
        <form id="frmcontrato" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Número de contrato</label></td>
                        <td><input type="number" name="numero_contrato" id="numero_contrato" class="validate[required,custom[onlyLetterNumber]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de Inicio de l Contrato</label></td>
                        <td><input type="date" name="fecha_contrato" id="fecha_contrato" class="validate[required,custom[TextoAcentosNum]] fecha" /></td>
                    </tr>
                    <tr>
                        <td><label>Valor</label></td>
                        <td><input type="number" name="valor_contrato" id="valor_contrato" class="validate[required,custom[numberP]] pesos" /></td>
                    </tr>
                    <tr>
                        <td><label>Proveedor</label></td>
                        <td>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" />
                            <input type="hidden" name="idproveedor" id="idproveedor" class="validate[required]" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>
        <?php
        break;
    case 'grados':
        ?>
        <form id="frmGrados" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'fuerza':
        ?>
        <form id="frmFuerza" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'paciente':
        require_once('../clases/tipodoc_class.php');
        require_once('../clases/fuerza_class.php');
        $tipo_doc = new tipodoc($conexion['local']);
        $fuerza = new fuerza($conexion['local']);
        ?>
        <form id="frmPaciente" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required]"); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td><input type="text" name="documento" id="documento" class="validate[required,custom[onlyLetterNumber]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[soloTextoAcentos]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Apellido</label></td>
                        <td><input type="text" name="apellidos" id="apellidos" class="validate[required,custom[soloTextoAcentos]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Fuerza</label></td>
                        <td><?= $fuerza->combobox("idfuerza", "idfuerza", "validate[required]"); ?></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>
        <?php
        break;
    case 'proveedor':
        require_once('../clases/tipodoc_class.php');
        $tipo_doc = new tipodoc($conexion['local']);
        ?>
        <form id="frmProveedor" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required] documento"); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td>
                            <input type="text" name="nodocumento" id="nodocumento" class="validate[required,custom[numberP]]" /> 
                            <input type="text" size="3" id="dv" name="dv" value="0" class="validate[custom[numberP]]" style="display:none" placeholder="DV" /> 
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre Proveedor</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>
        <?php
        break;
    case 'unidades':
        ?>
        <form id="frmUnidad" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'parentesco':
        ?>
        <form id="frmparentesco" class="formulario">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="70%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
}
?>