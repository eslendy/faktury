<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/contrato_class.php");
    $obj = new contrato($conexion['local']);
    $data = $obj->getall();
    //var_dump($dataUsers);
?>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_contrato.php" />
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
                        Nuevo Conntrato
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
                <td><input type="search" id="numero_contrato_search" placeholder="Buscar x No. Contrato" class="search_txt" /></td>
                <td><input type="search" id="fecha_contrato_search" placeholder="Buscar x fecha contrato" class="search_txt fecha" /></td>
                <td><input type="search" id="valor_contrato_search" placeholder="Buscar x valor" class="search_txt" /></td>
                <td><input type="search" id="proveedor_search" placeholder="Buscar x proveedor" class="search_txt" /></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>*/?>
            <tr>
                <th># CONTRATO</th>
                <th>FECHA CONTRATO</th>
                <th>VALOR</th>
                <th>PROVEEDOR</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $d) {?>
            <tr class="elemetoBusqueda">
                <td><?=$d['numero_contrato']?></td>
                <td><?=$d['fecha_contrato']?></td>
                <td><?=$d['valor_contrato']?></td>
                <td><?=$d['proveedor']?></td>
                <td><?=($d['estadoContrato']==1)?'Activo':'Inactivo'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editarReg(<?=$d['idcontrato']?>)"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularReg(<?=$d['idcontrato']?>)"></span>
                    </a>
                </td>
            </tr>
            <? }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" id="pager" class="holder" align="center">
                   
                </td>
            </tr>
        </tfoot>
    </table>
    
</div>
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/contrato.js"></script>