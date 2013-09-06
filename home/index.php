<?php

include "../menu/clases/menu_class.php";
$menu = new menu($conexion['local']);

?>
<div class="home_buttons">


    <h1>Hospital Militar</h1>
    <h2>Regional de Bucaramanga</h2>

    <h3> FAKTURY </h3>

    
     <? echo $menu->make_menu_home($_SESSION['perfil'], 0); ?>
    <?php
    /*
    <button class="btn btn-success" onclick="window.location = '/radicacion/'">
        <i class="icon-file-alt"></i>
        <span>RADICACION</span>
    </button>

    <button class="btn btn-success" onclick="window.location = '/auditoria_financiera/'">
        <i class="icon-medkit"></i>
        <span>AUDITORIA FINANCIERA</span>
    </button>

    <button class="btn btn-success" onclick="window.location = '/auditoria_medica/'">
        <i class="icon-user-md"></i>
        <span>AUDITORIA MEDICA</span>
    </button>

    <button class="btn btn-success" onclick="window.location = '/salir/'">
        <i class="icon-signout"></i>
        <span>SALIR</span>
    </button>
     * 
     */?>

</div>