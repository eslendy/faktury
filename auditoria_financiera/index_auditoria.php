<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/auditoria_financiera.php");
    $auditoria = new auditoria_financiera($conexion['local']);
    $data = $auditoria->getAll("f.estado=1".(( isset($_GET['idfactura'])&& $_GET['idfactura']>0)?' AND au.idFactura='.$_GET['idfactura']:''));
	
    //var_dump($dataFacturas);
?>
<input type="hidden" id="nombre_archivo" value="auditoria_financiera/index_auditoria.php" />
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
                <td><input type="search" id="fecha_rad_search" placeholder="Buscar x fecha" class="search_txt fecha" /></td>
                <td><input type="search" id="factura_search" placeholder="Buscar x No. Factura" class="search_txt" /></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th title="No. Radicado">ID</th>
                <th title="Fecha Radicación">FECHA AUDITORÍA.</th>
                <th>NO. FACTURA</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $fac) {?>
            <tr class="elemetoBusqueda">
                <td><?=$fac['idauditoria_financiera']?></td>
                <td><?=$fac['fecha_auditoria']?></td>
                <td><?=(($fac['prefijo']!="")?$fac['prefijo'].' ':'').$fac['numero_factura']?></td>
                <td><?=($fac['estado_au']==1)?'Activa':'Anulada'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editAuditoria(<?=$fac['idauditoria_financiera']?>,<?=$fac['idFactura']?>)" title="Editar Auditoría"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularAuditoria(<?=$fac['idauditoria_financiera']?>)" title="Anular auditoría"></span>
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
<script type="text/javascript" src="auditoria_financiera/js/auditoria_financiera_lista.js"></script>
