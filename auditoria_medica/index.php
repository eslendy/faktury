<?php
   
?>
<div id="menu_secundario">
    <div class="tituloModulo">
    	<span>Menú	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],($_GET['c']));?>
    </nav>

</div>
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_medica/js/auditoria_medica.js"></script>
<div id="contenedor">
    
</div>
