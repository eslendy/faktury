<?php
require("../../vigiaAjax.php");
require("../../libphp/config.inc.php");
require("../../libphp/mysql.php");
require("../clases/menu_class.php");
$menu = new menu($conexion['local']);
$menus = $menu->consultar($menu->_menu_sql("m.descripcion, m.idmenu", "m.padre=0", "m.idmenu", "m.orden"));
try {
    ?>
<h3>
    Crear Nuevo Men&uacute;
</h3>
    <form id="frm_add_menu">
        <table align="center" class="responsive table">
            <tbody>
               
                <tr>
                    <td align="right" width="25%" ><label>Nombre del menú</label></td>
                    <td><input type="text" value="" name="descripcion" id="descripcion" /></td>
                </tr>
                <tr>
                    <td align="right"><label>Archivo de Enlace</label></td>
                    <td id="tdTreeFile">
                        <input type="text" value="" name="enlace" id="enlace" />
                        
                    </td>
                </tr>
                <tr>
                    <td align="right"><label>Menú Padre</label></td>
                    <td>
                        <select name="padre" id="padre">
                            <option value="0">Men&uacute; Principal</option>
                            <?
                            foreach ($menus as $m) {
                                echo '<option value="' . $m['idmenu'] . '">' . $m['descripcion'] . '</option>';
                                echo $menu->submenu_option($m['idmenu'], "", "");
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
                        <select name="modulos[]" id="modulos" multiple size="10" >
                            <option value="-1" selected>Seleccione</option>
                            <?
                            $modulos = $bd->consultar("SELECT * FROM modulo");
                            foreach ($modulos as $mod) {
                                echo '<option value="' . $mod['idmodulo'] . '">' . $mod['descripcion'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

           	</tbody>
        </table>
    </form>
<table class="table table-btn">
    
<tr>
        	<td colspan="2">
            	<input type="button" value="Guardar" name="guardar" id="guardar" class="btn btn-primary btn-large pull-right">
              
            </td>
        </tr>
</table>


    <?
} catch (Exception $e) {
    echo $e->getMessage();
}
?>