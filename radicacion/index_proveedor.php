<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/proveedor_class.php");
    $obj = new proveedor($conexion['local']);
    $data = $obj->getall();
    //var_dump($dataUsers);
?>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_proveedor.php" />
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
                        Nuevo Proveedor
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
                <td></td>
                <td><input type="search" id="doc_proveedor_search" placeholder="Buscar x docuemnto" class="search_txt fecha" /></td>
                <td><input type="search" id="nombre_proveedor_search" placeholder="Buscar x nombre" class="search_txt fecha" /></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>ID</th>
                <th>DOCUMENTO</th>
                <th>NOMBRE</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $d) {?>
            <tr class="elemetoBusqueda">
                <td><?=$d['idproveedor']?></td>
                <td><?=$d['desTipod'].' '.$d['nodocumento'].(($d['idtipo_doc']=='2')?' - '.$d['dv']:'')?></td>
                <td><?=$d['nombre']?></td>
                <td><?=($d['estadoProveedor']==1)?'Activo':'Inactivo'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editarReg(<?=$d['idproveedor']?>)"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularReg(<?=$d['idproveedor']?>)"></span>
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
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/proveedor.js"></script>