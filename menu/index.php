
<div id="menu_secundario">
	<div class="tituloModulo">
    	<span>Menú	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],base64_decode($_GET['p']));?>
    </nav>

</div>
<div id="contenedor">
    <div id="datosBasicos">

    	<? //if($p[$sContenido]['add']==1 || $p[$file]['add']==1): ?>
    	
        <? //else:
			//include('vigiaFiles.php');
		//endif;?>
    </div>
</div>
<script src="menu/js/menu.js"></script>