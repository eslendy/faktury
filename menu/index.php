
<div id="menu_secundario">
	<div class="tituloModulo">
    	<span>Menú	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],($_GET['c']));?>
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
<script src="<? echo $SERVER_NAME; ?>menu/js/menu.js"></script>