<?php
    include("perfiles/clases/perfiles_class.php");
    $perfiles = new perfil($conexion['local']);
    $dataPerfil = $perfiles->getallPerfiles();
    //var_dump($dataUsers);
?>
<div id="menu_secundario">
    <div class="tituloModulo">
    	<span>Perfiles	</span>
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
                            Nuevo Perfil
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
                    <td width="10%"></td>
                </tr>
                <tr>
                    <th width="5%">ITEM</th>
                    <th width="75%">DESCRIPCIÓN</th>
                    <th width="10%">ESTADO</th>
                    <th width="10%">EDITAR</th>
                    <th width="10%">PERMISOS</th>
                </tr>
            </thead>
            <tbody id="lista">
                <? $i=1; 
                foreach ($dataPerfil as $per) {?>
                <tr class="elemetoBusqueda">
                    <td width="5%"><?=$i++?></td>
                    <td><?=$per['descripcion']?></td>
                    <td><?=($per['estado']==1)?'Activo':'Inactivo'?></td>
                    <td width="10%">
                        <a>
                            <span class="editarBtn" onclick="_editarReg(<?=$per['idperfil']?>)"></span>
                        </a>
                    </td>
                    <td width="10%">
                        <a>
                            <span class="permisosBtn" onclick="_asigPermisos(<?=$per['idperfil']?>)"></span>
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
<script type="text/javascript" src="perfiles/js/perfil.js"></script>