<?
require("../../vigiaAjax.php");
require("../../libphp/config.inc.php");
require("../../libphp/mysql.php");
require("../clases/menu_class.php");
$menu = new menu($conexion['local']);
$menus=$menu->consultar($menu->_menu_sql("m.descripcion, m.idmenu","m.padre=0","m.idmenu","m.orden"));
$data=array();
if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']!=0){
    $data=$menu->getMenuData("m.idmenu=".$_GET['id']);
}
?>        	
<div id="datosBasicos">
    <h3>Editar Menu</h3>
    <form id="frm_edit_menu" class="responsive table">
	<table align="center" class="tablas_form">
    	
        <tbody>
        <tr>
            <td colspan="3">
            	<div id="mensaje"></div>
        	</td>
        </tr>
        <tr>
        	<td rowspan="6" bordercolor="#333333" width="30%">
            	<?=$menu->DrawMenuList('0',$SERVER_NAME."menu/ajax/form_edit_menu.php");?>
            </td>
            <td></td>
            <td></td>
        </tr>
    	<tr>
        	<td align="right" width="20%"><label>Nombre del menú</label></td>
            <td width="50%">
            	<input type="hidden" value="<?=$data['idmenu']?>" name="idmenu" id="idmenu" />
                <input type="text" value="<?=$data['descripcion']?>" name="descripcion" id="descripcion" />
            </td>
        </tr>
        <tr>
        	<td align="right"><label>Archivo de Enlace</label></td>
            <td id="tdTreeFile">
            	<input type="text" value="<?=$data['enlace']?>" name="enlace" id="enlace" />
                
            </td>
        </tr>
        <tr>
        	<td align="right"><label>Menú Padre</label></td>
            <td>
            	<select name="padre" id="padre">
                	<option value="0">Men&uacute; Principal</option>
                	<?
					foreach($menus as $m){
						
						$sel = ($m['idmenu']==$data['padre'])?'selected="selected"':'';
						echo '<option value="'.$m['idmenu'].'" '.$sel.'>'.$m['descripcion'].'</option>';
						echo $menu->submenu_option($m['idmenu'],"",$padre);
					}
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label>Visible En la barra de Menú</label></td>
            <td>
                <select name="visible" id="visible">

                    <option value="-1">Seleccione</option>
                    <option value="0" <?= ($data['visible']==0)?'selected="selected"':'';?> >No</option>
                    <option value="1" <?= ($data['visible']==1)?'selected="selected"':'';?> >Si</option>
                </select>
            </td>
        </tr>
        
        <tr>
        	<td align="right"><label>Estado</label></td>
            <td>                   
                <input type="radio" name="estado" id="estado_true" value="1" <?=($data['estado']==1)?'checked="checked"':'';?> />Activo
                <br />
                <input type="radio" name="estado" id="estado_false" value="0" <?=($data['estado']==0)?'checked="checked"':'';?> />Inactivo
            </td>
        </tr>
		</tbody>
    </table>
</form>
<table class="responsive table">
	<tbody>
    <tr>
        <td colspan="3">

            <button id="guardar" class='btn btn-primary pull-right btn-large'>
                Guardar
            </button>
        </td>
    </tr>
    </tbody>
</table>

</div>
