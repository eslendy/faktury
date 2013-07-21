<div id="menu_secundario" class="pull-left span3">
    <div class="tituloModulo">
        <span>Menú	</span>
    </div>
    <?= $menu->menu_lateral($_SESSION['perfil'], ($_GET['c'])); ?>
</div>

<div id="contenedor" class="pull-left span9">

</div>
<div class="clear"></div>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_financiera/js/auditoria_financiera.js"></script>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_medica/js/auditoria_medica.js"></script>
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/radicacion.js"></script>