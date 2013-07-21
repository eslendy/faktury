<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/fuerza_class.php");
    $obj = new fuerza($conexion['local']);
    $data = $obj->getallFuerzas();
    //var_dump($dataUsers);
?>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_fuerza.php" />
<div id="operaciones"> 
	<table class="responsive table">
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
                        Nueva Fuerza
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="contenido">
    <table id="reporte" class="responsive table">
        <thead>
            <? /*<tr id="trBuscar" class="oculto">
                <td></td>
                <td><input type="search" id="descripcion_search" placeholder="Buscar x Descripcion" class="search_txt" /></td>
                <td><input type="search" id="abreviatura_search" placeholder="Buscar x abreviatura" class="search_txt" /></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>*/ ?>
            <tr>
                <th>ID</th>
                <th>DESCRIPCION</th>
                <th>ABREVIATURA</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $u) {?>
            <tr class="elemetoBusqueda">
                <td><?=$u['idfuerza']?></td>
                <td><?=$u['descripcion']?></td>
                <td><?=$u['abreviatura']?></td>
                <td><?=($u['estado']==1)?'Activo':'Inactivo'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editarReg(<?=$u['idfuerza']?>)"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularReg(<?=$u['idfuerza']?>)"></span>
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
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/fuerza.js"></script>