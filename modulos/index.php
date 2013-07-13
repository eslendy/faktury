<?php
    include("modulos/clases/modulo_class.php");
    $modulos = new modulo($conexion['local']);
    $dataModulo = $modulos->getallModulos();
    //var_dump($dataUsers);
?>
<div id="menu_secundario">
    <div class="tituloModulo">
    	<span>Modulos	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],base64_decode($_GET['p']));?>
    </nav>

</div>
<div id="contenedor">
    <div id="operaciones"> 
    	<table>
        	<thead>
            </thead>
            <tbody>
            	<tr>
                	<td>
                    	<button class="busqueda">
                        	Buscar
                    	</button>
                    </td>
                    <td>
                        <button class="nuevoReg">
                            Nuevo Modulo
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div id="contenido">
        <table id="reporte" width="80%" align="center" class="tablesorter">
            <thead>
                <tr id="trBuscar" class="oculto">
                    <td width="5%"></td>
                    <td width="75%"><input type="search" id="descripcion_search" placeholder="Buscar x Nombres" class="search_txt" /></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                </tr>
                <tr>
                    <th width="5%">ITEM</th>
                    <th width="75%">DESCRIPCIÓN</th>
                    <th width="10%">ESTADO</th>
                    <th width="10%">EDITAR</th>
                </tr>
            </thead>
            <tbody id="lista">
                <? $i=1; 
                foreach ($dataModulo as $mod) {?>
                <tr class="elemetoBusqueda">
                    <td width="5%"><?=$i++?></td>
                    <td><?=$mod['descripcion']?></td>
                    <td><?=($mod['estado']==1)?'Activo':'Inactivo'?></td>
                    <td width="10%">
                        <a>
                            <span class="editarBtn" onclick="_editarReg(<?=$mod['idmodulo']?>)"></span>
                        </a>
                    </td>
                </tr>
                <? }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" id="pager" class="holder" align="center">
                       
                    </td>
                </tr>
            </tfoot>
        </table>
        
    </div>
</div>
<script type="text/javascript" src="modulos/js/modulo.js"></script>