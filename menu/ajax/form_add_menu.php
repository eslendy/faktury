<?php
require("../../vigiaAjax.php");
require("../../libphp/config.inc.php");
require("../../libphp/mysql.php");
require("../clases/menu_class.php");
$menu = new menu($conexion['local']);
$menus=$menu->consultar($menu->_menu_sql("m.descripcion, m.idmenu","m.padre=0","m.idmenu","m.orden"));
try{
?>
<form id="frm_add_menu">
	<table align="center" class="tablas_form">
    	<thead>
    	<tr>
        	<th colspan="2">Crear Nuevo Men&uacute;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        	<td colspan="2">
            	<div id="mensaje">
                </div>
            </td>
        </tr>
    	<tr>
        	<td align="right" width="50%"><label>Nombre del menú</label></td>
            <td><input type="text" value="" name="descripcion" id="descripcion" /></td>
        </tr>
        <tr>
        	<td align="right"><label>Archivo de Enlace</label></td>
            <td id="tdTreeFile">
            	<span id="nameFile" style="color:#FFF; background:#49B916;"></span><input type="button" id="cleanFile" name="cleanFile" value=" - " title="Quitar Archivo" style="display:none;"/>
            	<input type="text" value="" name="enlace" id="enlace" />
                <?php echo $menu->FileTree($folders['absoluta']);?>
                
            </td>
        </tr>
        <tr>
        	<td align="right"><label>Menú Padre</label></td>
            <td>
            	<select name="padre" id="padre">
                	<option value="0">Men&uacute; Principal</option>
                	<?
					foreach($menus as $m){
						echo '<option value="'.$m['idmenu'].'">'.$m['descripcion'].'</option>';
						echo $menu->submenu_option($m['idmenu'],"","");
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
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label>Modulos</label></td>
            <td>
                <select name="modulos[]" id="modulos" multiple>
                	<option value="-1" selected>Seleccione</option>
                    <? 
                    $modulos = $bd->consultar("SELECT * FROM modulo");
                    foreach ($modulos as $mod) {
                        echo '<option value="'.$mod['idmodulo'].'">'.$mod['descripcion'].'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
        	<td colspan="2" align="center">
            	<input type="button" value="Guardar" name="guardar" id="guardar"/>
                <input type="reset" value="Limpiar" name="clean" id="clean" />
            </td>
        </tr>
       	</tbody>
    </table>
</form>
<? 
}catch(Exception $e){
	echo $e->getMessage();
}
?>