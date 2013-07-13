<?php
   
?>
<div id="menu_secundario">
    <div class="tituloModulo">
    	<span>Menú	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],base64_decode($_GET['p']));?>
    </nav>

</div>
<script type="text/javascript" src="radicacion/js/radicacion.js"></script>
<div id="contenedor">
    
</div>
