<?
require("../../vigiaAjax.php");
require("../../libphp/config.inc.php");
require("../../libphp/mysql.php");
require("../clases/menu_class.php");
$menu = new menu($conexion['local']);
$padreP = (!isset($_GET['pa']) || $_GET['pa'] == "") ? 0 : $_GET['pa'];
$padre = (!isset($_GET['id']) || $_GET['id'] == "") ? 0 : $_GET['id'];
$menu1 = $menu->consultar($menu->_menu_sql("m.descripcion, m.idmenu, m.orden", "m.idmenu = " . $padreP . " AND m.estado!=0", "m.idmenu", "m.orden"));
$menu2 = $menu->consultar($menu->_menu_sql("m.descripcion, m.idmenu, m.orden", "m.padre = " . $padre . " AND m.estado!=0", "m.idmenu", "m.orden"));
//$pos_menu->getOnlyData($_GET['id'],"id_menu");
?>
<style>
    #sortable, #sortable2 { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li, #sortable2 li { margin: 0 3px 3px 3px; border:#999 1px dotted; }
    #sortable li span, #sortable2 li span { position: absolute; margin-left: -1.3em; }
    #sortable li a, #sortable2 li a { float:right;  }
</style>
<!--<script src="../js/ordenMenu.js"></script>-->
<script>
    $("#sortable2").sortable({
        change: function(event, ui) {
            id = $(".ui-sortable-helper").attr('id');
        },
        stop: function() {
            //var index = $("#sortable2 li" ).index( $("#"+id));
            //$("#"+id).val(index);
            valores = "";
            $(".ui-selectee", this).each(function() {
                if (this.id != "") {
                    var index = $("#sortable2 li").index($('#' + this.id));
                    valores += this.id + "=" + (index + 1) + "&";
                    $('#' + this.id).val(index + 1);
                }
            });
            valores = valores.substr(0, valores.length - 1);
        }
    }).selectable();
    $('#guardar').click(function() {
        if (validar()) {
            _ajax(init.XNG_WEBSITE_URL + 'menu/ajax/saveMenu.php?type=orden', valores, function(html_response) {
                if (html_response == 1) {
                    _msgexito("Menú Ordenado!!", '#mensaje');
                } else {
                    _msgerror(html_response, '#mensaje');
                }
            })
        }
    });
</script>
<div id="cuenta">
    <div id="datosBasicos">
        <h3>Orden del Menu</h3>
        <form id="frm_orden_menu">
            <table class="responsive table">

                <tbody>
                    <tr>
                        <td colspan="3">
                            <div id="mensaje"></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="100"></td>
                        <td>
                            <ul id="sortable">
                                <li id="1_0" value="0">
                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                    <a href="#" onclick="_ordenar('<? echo $SERVER_NAME; ?>menu/ajax/ordenMenu.php', 0, 0)">Barra Men&uacute;</a><br />
                                </li>
                                <? foreach ($menu1 as $m) { ?>
                                    <li id="1_<?= $m['idmenu'] ?>" value="<?= $m['orden'] ?>">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <?= $m['descripcion'] ?> 
                                        <a href="#" onclick="_ordenar('<? echo $SERVER_NAME; ?>menu/ajax/ordenMenu.php',<?= $m['idmenu'] ?>,<?= $m['idmenu'] ?>)">Sub Men&uacute;</a>
                                    </li>
                                <? } ?>
                            </ul>
                        </td>
                        <td>
                            <ul id="sortable2">
                                <? foreach ($menu2 as $m) { ?>
                                    <li id="2_<?= $m['idmenu'] ?>" value="<?= $m['orden'] ?>">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <?= $m['descripcion'] ?> 
                                        <a href="#" onclick="_ordenar('<? echo $SERVER_NAME; ?>menu/ajax/ordenMenu.php',<?= $m['idmenu'] ?>,<?= $m['idmenu'] ?>)">Sub Men&uacute;</a>
                                    </li>
                                <? } ?>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" >
                            <input type="button" value="Guardar" name="guardar" id="guardar" class='btn btn-primary btn-large pull-right'/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

    </div>
</div>
