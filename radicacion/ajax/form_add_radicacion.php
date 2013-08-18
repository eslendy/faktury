<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
switch ($_REQUEST['case']) {
    case 'factura':
        ?>
        <form id="frmfactura" class="formulario" method="post">
            <table class="responsive table table-striped">

                <tbody>
                    <tr>
                        <td>
                            <label>Mes de Radicado</label>
                            <select name="mes_radicado" class="">
                                <?php
                                $rango = 12;
                                for ($i = 1; $i <= $rango; $i++) {
                                    $meses = date('F', mktime(0, 0, 0, $i, 1, date("Y")));

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

                                    echo "<option value='$i'>$meses</option>";
                                }
                                ?> 
                            </select>
                        </td>
                        <td>

                            <label>Número Radicado</label>
                            <input type="text" name="no_radicado" id="no_radicado" class="validate[required,custom[numberP]]" data-prompt-position="centerRight:1,-5"/>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label>Número Factura</label>
                            <input type="text" name="numero_factura" id="numero_factura" class="validate[required,custom[onlyNumberSp]]" data-prompt-position="centerRight:1,-5"/>


                        </td>
                        <td>
                            <label>Prefijo Factura</label>
                            <input type="text" name="prefijo" id="prefijo" class="validate[custom[onlyLetterSp]]" data-prompt-position="centerRight:1,-5"/>

                        </td>
                    </tr>

                    <tr>
                        <td>

                            <label>Valor de la Factura</label>
                            <input type="number" name="valor" id="valor" class="validate[required,custom[numberP]] pesos" data-prompt-position="centerRight:1,-5"/>

                        </td>
                        <td>

                            <label>Fecha de emisión Factura</label>
                            <input type="text" name="fecha_emision" id="fecha_emision" class="fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5" />

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Fecha de presentacion Factura</label>
                            <input type="text" name="fecha_presentacion" id="fecha_presentacion" class="fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5" />

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Proveedor</label>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5"/>
                            <input type="hidden" id="idproveedor" name="idproveedor" class="validate[required]" />


                        </td>
                        <td>
                            <label>Contrato</label>
                            <div id="td_contrato"></div>


                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label>Unidad de Atención GAVD-CENAF</label>
                            <input type="text" id="autoc-idunidad_atencion" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5"/>
                            <input type="hidden" id="idunidad_atencion" name="idunidad_atencion"  />

                        </td>
                        <td>
                            <label>Unidad Centralizada</label>
                            <input type="text" id="autoc-idcentralizada" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5" />
                            <input type="hidden" id="idcentralizada" name="idcentralizada"  />

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Unidad Centralizadora</label>
                            <input type="text" id="autoc-idcentralizadora" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5"/>
                            <input type="hidden" id="idcentralizadora" name="idcentralizadora"  />


                        </td>
                        <td>
                            <label>Paciente</label>
                            <input type="text" id="autoc-idpaciente" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5"/>
                            <input type="hidden" id="idpaciente" name="idpaciente" />
                            <input type="hidden" id="idunidad" name="idunidad" value="1" />

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <label>Unidad del Paciente</label>
                            <input type="radio" name="idparentesco" id="idparentescoT" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Titular </span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoB" value="2" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Beneficiario</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoR" value="3" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Retirado</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input type="radio" name="idparentesco" id="idparentescoP" value="4" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Pensionado</span>

                        </td>
                    </tr>
                    <tr>
                        <? /*<td>
                            <label>Unidad del Paciente</label>
                            <input type="text" id="autoc-idunidad" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt ui-autocomplete-input" data-prompt-position="centerRight:1,-5" autocomplete="off">
                            <input type="hidden" id="idunidad" name="idunidad">
                        </td>*/?>
                        <td colspan="2"><label>Grado del Paciente</label> 
                            <input type="text" id="autoc-idgrado" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5" />
                            <input type="hidden" id="idgrado" name="idgrado" class="validate[required]" /></td>

                    </tr>
                    <tr>
                        <td>
                            <label>Número Autorización</label>
                            <input type="text" name="no_autorizacion" id="no_autorizacion" class="validate[required,custom[onlyNumberSp]] " data-prompt-position="centerRight:1,-5"/>
                        </td>
                        <td><label>Fecha Autorización del Servicio</label>
                            <input type="text" name="fecha_autorizacion_servicio" id="fecha_autorizacion_servicio" class="fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5"/>
                        </td>
                    </tr>


                    <tr>
                        <td><label>Fecha Ingreso del Paciente</label>
                            <input type="text" name="fecha_ingreso_paciente" id="fecha_ingreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5"/>
                        </td>
                        <td><label>Fecha Salida del Paciente</label>
                            <input type="text" name="fecha_egreso_paciente" id="fecha_egreso_paciente" class="fecha validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5"/>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>

                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">En Proceso</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Paga</span>

                        </td>
                        <td>

                        </td>
                    </tr>

                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?= $_SESSION['usrid'] ?>" />
        </form>

        <?php
        break;
    case 'unidadAtencion':
        ?>
        <form id="frmunidadAtencion" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td>Und. Centralizadora</td>
                        <td>
                            <select id="centralizada" name="centralizada" data-prompt-position="centerRight:1,-5" class="validate[required,funcCall[_validarHiddenAutoC]]">
                                <option value="0" >NO</option>
                                <option value="1" >SI</option>
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'contrato':
        ?>
        <form id="frmcontrato" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="30%"><label>Número de contrato</label></td>
                        <td><input type="number" name="numero_contrato" id="numero_contrato" class="validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Fecha de Inicio de l Contrato</label></td>
                        <td><input type="text" name="fecha_contrato" id="fecha_contrato" class="validate[required,custom[TextoAcentosNum]] fecha" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Valor</label></td>
                        <td><input type="number" name="valor_contrato" id="valor_contrato" class="validate[required,custom[numberP]] pesos" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Proveedor</label></td>
                        <td>
                            <input type="text" id="autoc-idproveedor" class="validate[required,funcCall[_validarHiddenAutoC]] autoc_txt" data-prompt-position="centerRight:1,-5"/>
                            <input type="hidden" name="idproveedor" id="idproveedor" class="validate[required]" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>

                        </td>
                        <td>

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
        <form id="frmgrados" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'fuerza':
        ?>
        <form id="frmfuerza" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="30%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/><span class="text-title"> Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/><span class="text-title"> Inactivo</span>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'pacientes':
        require_once('../clases/tipodoc_class.php');
        require_once('../clases/fuerza_class.php');
        $tipo_doc = new tipodoc($conexion['local']);
        $fuerza = new fuerza($conexion['local']);
        ?>
        <form id="frmpacientes" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="30%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required]"); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td><input type="text" name="documento" id="documento" class="validate[required,custom[onlyLetterNumber]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[soloTextoAcentos]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Apellido</label></td>
                        <td><input type="text" name="apellidos" id="apellidos" class="validate[required,custom[soloTextoAcentos]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Fuerza</label></td>
                        <td><?= $fuerza->combobox("idfuerza", "idfuerza", "validate[required]"); ?></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>
                        </td>
                        <td>

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
        <form id="frmproveedor" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="30%"><label>Tipo de Documento</label></td>
                        <td><?= $tipo_doc->combobox("idtipo_doc", "idtipo_doc", "validate[required] documento"); ?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td>
                            <input type="text" name="nodocumento" id="nodocumento" class="validate[required,custom[numberP]]" data-prompt-position="centerRight:1,-5"/> 
                            <input type="text" size="3" id="dv" name="dv" value="0" class="validate[custom[numberP]]" style="display:none" placeholder="DV" data-prompt-position="centerRight:1,-5"/> 
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre Proveedor</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>
                        </td>
                        <td>

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
        <form id="frmunidad" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="30%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[required,funcCall[_validarHiddenAutoC]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
    case 'parentesco':
        ?>
        <form id="frmparentesco" class="formulario" method="post">
            <table class="responsive table">
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%"><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" data-prompt-position="centerRight:1,-5"/></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label>
                            <input type="radio" name="estado" id="estado1" value="1" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Activo</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="estado" id="estado0" value="0" class="validate[required]" data-prompt-position="centerRight:1,-5"/> <span class="text-title">Inactivo</span>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
        break;
}
?>
<table class="table table-btn">
    <tr>
        <td width="90%"></td>
        <td width="10%">
            <button class="btn btn-success guardar-formulario btn-large" data-relation="<? echo $_REQUEST['case'] ?>">Guardar</button>
        </td>
    </tr>
</table>

<script>
    $('.guardar-formulario').submit(function(e) {
        $.preventDefault(e);

    })




    $('.guardar-formulario').click(function(e) {

        console.log('das')
        if ($('#frm' + $(this).attr('data-relation')).validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/save.php?type=add' + $(this).attr('data-relation'), $('#frm' + $(this).attr('data-relation')).serialize(), function(data) {
                switch (data) {
                    case '1':
                        alert("<? echo $_REQUEST['case'] ?> Guardado con Éxito!!");
                        $("#dialog-addModRad").remove();
                        _loadContenido($('#nombre_archivo').val());
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
        $(".fecha").datepicker({
            showOn: "button",
            buttonImage: "/imagenes/calendar.gif",
            buttonImageOnly: true,
            dateFormat: "yy-mm-dd"
        });
    });
</script>