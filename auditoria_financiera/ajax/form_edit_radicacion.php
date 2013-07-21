<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/udAtencion_class.php');
include('../clases/grados_class.php');
include('../clases/fuerza_class.php');
require_once('../clases/tipodoc_class.php');
require_once('../clases/paciente_class.php');
require_once('../clases/proveedor_class.php');
require_once('../clases/unidades_class.php');

switch($_GET['case']){
	case 'factura':?>
        <form id="frmRadicacion" class="formulario">
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td><label>Prefijo Fatura</label></td>
                    	<td><input type="text" name="prefijo" id="prefijo" class="validate[custom[onlyLetterNumber]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Número Factura</label></td>
                        <td>
                        	<input type="text" name="numero_factura" id="numero_factura" class="validate[required,custom[onlyLetterNumber]]" />
                        </td>
                    </tr>
                    <tr>
                    	<td><label>Fecha de Facturación</label></td>
                        <td><input type="date" name="fecha_emision" id="fecha_emision" class="fecha validate[required,custom[date2]]" /></td>
                    </tr>
                    <tr>
                    	<td><label>Valor de la Factura</label></td>
                        <td><input type="number" name="valor" id="valor" class="validate[required,custom[numberP]]" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" /></span>
        
                        </td>
                    </tr>
                    <tr>
                    	<td><label>Unidad de Atención</label></td>
                        <td>
                        	<input type="text" id="autoc_idunidad_atencion" />
                        	<input type="hidden" id="idunidad_atencion" name="idunidad_atencion" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

<?php
	break;
    case 'undAtencion':
	    $unds = new undidad_atencion($conexion['local']);
	    $dataUnds = $unds->getUnidad($_POST['idunidad_atencion']);
	    ?>
	    <form id="frmUndAtencion" class="formulario">
	    	<input type="hidden" name="idunidad_atencion" id="idunidad_atencion" value="<?=$dataUnds['idunidad_atencion']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?=$dataUnds['descripcion']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($dataUnds['estado']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($dataUnds['estado']==0)?'checked="checked"':''?> /></span>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<?php
    break;
    case'grados':
        $obj = new grados($conexion['local']);
        $data = $obj->getGrado($_POST['idgrado']);
        ?>
        <form id="frmGrados" class="formulario">
            <input type="hidden" name="idgrado" id="idgrado" value="<?=$data['idgrado']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?=$data['descripcion']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" value="<?=$data['abreviatura']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($data['estado']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($data['estado']==0)?'checked="checked"':''?> /></span>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<?php
    break;
	case'fuerza':
        $obj = new fuerza($conexion['local']);
        $data = $obj->getFuerza($_POST['idfuerza']);
        ?>
        <form id="frmFuerza" class="formulario">
            <input type="hidden" name="idfuerza" id="idfuerza" value="<?=$data['idfuerza']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?=$data['descripcion']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Abreviatura</label></td>
                        <td><input type="text" name="abreviatura" id="abreviatura" class="validate[custom[TextoAcentosNum]]" value="<?=$data['abreviatura']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($data['estado']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($data['estado']==0)?'checked="checked"':''?> /></span>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<?php
    break;
	case 'paciente':
		
		$tipo_doc = new tipodoc($conexion['local']);
		$fuerza = new fuerza($conexion['local']);
		$paciente = new paciente($conexion['local']);
		$data = $paciente->getOne($_POST['idpaciente']);
		
	?>
    	<form id="frmPaciente" class="formulario">
		    <input type="hidden" name="idpaciente" id="idpaciente" value="<?=$data['idpaciente']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td><label>Tipo de Documento</label></td>
                        <td><?=$tipo_doc->combobox("idtipo_doc","idtipo_doc","validate[required]",$data['idtipo_doc']);?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td><input type="text" name="documento" id="documento" class="validate[required,custom[onlyLetterNumber]]" value="<?=$data['documento']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[soloTextoAcentos]]" value="<?=$data['nombre']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Apellido</label></td>
                        <td><input type="text" name="apellidos" id="apellidos" class="validate[required,custom[soloTextoAcentos]]" value="<?=$data['apellidos']?>" /></td>
                    </tr>
                    <tr>
                    	<td><label>Fuerza</label></td>
                        <td><?=$fuerza->combobox("idfuerza","idfuerza","validate[required]",$data['idfuerza']);?></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($data['estadoPaciente']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($data['estadoPaciente']==0)?'checked="checked"':''?> /></span>
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
		$data = $proveedor->getOne($_POST['idproveedor']);
		
		
	?>
    	<form id="frmProveedor" class="formulario">
        	<input type="hidden" name="idproveedor" id="idproveedor" value="<?=$data['idproveedor']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td><label>Tipo de Documento</label></td>
                        <td><?=$tipo_doc->combobox("idtipo_doc","idtipo_doc","validate[required] documento",$data['idtipo_doc']);?></td>
                    </tr>
                    <tr>
                        <td><label>No. Documento</label></td>
                        <td>
                        	<input type="text" name="nodocumento" id="nodocumento" class="validate[required,custom[numberP]]" value="<?=$data['nodocumento']?>" />
                            <input type="text" size="3" id="dv"  class="validate[custom[numberP]]" name="dv" <?=($data['idtipo_doc']!=2)?'style="display:none;"':''?> placeholder="DV" value="<?=$data['dv']?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre Proveedor</label></td>
                        <td><input type="text" name="nombre" id="nombre" class="validate[required,custom[TextoAcentosNum]]" value="<?=$data['nombre']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($data['estadoProveedor']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($data['estadoProveedor']==0)?'checked="checked"':''?> /></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="idusuario" id="idusuario" value="<?=$_SESSION['usrid']?>" />
        </form>
<?php
    break;
	case 'unidades':
	    $unds = new undidad($conexion['local']);
	    $dataUnds = $unds->getOne($_POST['idunidad']);
	    ?>
	    <form id="frmUnidad" class="formulario">
	    	<input type="hidden" name="idunidad" id="idunidad" value="<?=$dataUnds['idunidad']?>" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2"><div id="mensaje"></div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" class="validate[custom[TextoAcentosNum]]" value="<?=$dataUnds['descripcion']?>" /></td>
                    </tr>
                    <tr>
                        <td><label>Estado</label></td>
                        <td>
                            <span style="display:block;"><label>Activo</label><input type="radio" name="estado" id="estado1" value="1" class="validate[required]" <?=($dataUnds['estado']==1)?'checked="checked"':''?> /></span>
                            <span style="display:block;"><label>Inactivo</label><input type="radio" name="estado" id="estado0" value="0" class="validate[required]" <?=($dataUnds['estado']==0)?'checked="checked"':''?> /></span>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<?php
    break;
}
?>