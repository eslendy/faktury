<?php

include "../menu/clases/menu_class.php";
$menu = new menu($conexion['local']);

?>
<div class="home_buttons">


    <h1>Hospital Militar</h1>
    <h2>Regional de Bucaramanga</h2>

    <h3> FAKTURY </h3>

    
     <?php echo $menu->make_menu_home($_SESSION['perfil'], 0); ?>
    

</div>