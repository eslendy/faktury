<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/unidades_class.php");
    $unds = new undidad($conexion['local']);
    $data = $unds->getall();
    //var_dump($dataUsers);
?>
<input type="hidden" id="nombre_archivo" value="radicacion/index_unidades.php" />
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
                        Nueva Unidad
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="contenido">
    <table id="reporte" align="center" class="tablesorter">
        <thead>
            <tr id="trBuscar" class="oculto">
                <td></td>
                <td><input type="search" id="descripcion_search" placeholder="Buscar x Descripcion" class="search_txt" /></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>ID</th>
                <th>DESCRIPCION</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $u) {?>
            <tr class="elemetoBusqueda">
                <td><?=$u['idunidad']?></td>
                <td><?=$u['descripcion']?></td>
                <td><?=($u['estado']==1)?'Activo':'Inactivo'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editarReg(<?=$u['idunidad']?>)"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularReg(<?=$u['idunidad']?>)"></span>
                    </a>
                </td>
            </tr>
            <? }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" id="pager" class="holder" align="center">
                   
                </td>
            </tr>
        </tfoot>
    </table>
    
</div>
<script type="text/javascript" src="radicacion/js/unidades.js"></script>