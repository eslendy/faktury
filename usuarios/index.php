<?php
    include("usuarios/clases/usuarios_class.php");
    $users = new usuarios($conexion['local']);
    $dataUsers = $users->getallUsers();
    //var_dump($dataUsers);
?>
<div id="menu_secundario">
    <div class="tituloModulo">
    	<span>Usuarios	</span>
    </div>
    <nav>
        <?=$menu->menu_lateral($_SESSION['perfil'],($_GET['c']));?>
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
                    	<button class="busqueda btn btn-success">
                        	Buscar
                    	</button>
                    </td>
                    <td>
                        <button class="nuevoReg btn btn-primary">
                            Nuevo Usuario
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
                    <td width="30%"><input type="search" id="nombre_search" placeholder="Buscar x Nombres" class="search_txt" /></td>
                    <td width="30%"><input type="search" id="apellido_search" placeholder="Buscar x Apellidos" class="search_txt" /></td>
                    <td width="20%"></td>
                    <td width="5%"></td>
                    <td width="5%"></td>
                    <td width="5%"></td>
                </tr>
                <tr>
                    <th width="5%">ITEM</th>
                    <th width="30%">NOMBRES</th>
                    <th width="30%">APELLIDOS</th>
                    <th width="20%">EMAIL</th>
                    <th width="5%">ESTADO</th>
                    <th width="5%">EDITAR</th>
                    <th width="5%">PERFILES</th>
                </tr>
            </thead>
            <tbody id="lista">
                <? $i=1; 
                foreach ($dataUsers as $usr) {?>
                <tr class="elemetoBusqueda">
                    <td width="5%"><?=$i++?></td>
                    <td><?=$usr['nombres']?></td>
                    <td><?=$usr['apellidos']?></td>
                    <td><?=$usr['email']?></td>
                    <td><?=($usr['estado']==1)?'Activo':'Inactivo'?></td>
                    <td width="5%">
                        <a>
                            <span class="editarBtn" onclick="_editarReg(<?=$usr['idusuarios']?>)"></span>
                        </a>
                    </td>
                    <td width="5%">
                        <a>
                            <span class="perfilBtn" onclick="_addPerfil(<?=$usr['idusuarios']?>)"></span>
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
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>usuarios/js/usuarios.js"></script>