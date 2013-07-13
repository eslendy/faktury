<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("../radicacion/clases/facturas_class.php");
    include("clases/auMedica_class.php");
    $facturas = new facturas($conexion['local']);
    $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, 
    IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera, f.idFactura as idFactura";
    $where = "f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor = ".$_SESSION['usrid'].")";
    $dataFacturas = $facturas->getall($campos,$where);
    //var_dump($dataFacturas);
    $auMedica = new auMedica($conexion['local']);
?>
<input type="hidden" id="nombre_archivo" value="auditoria_medica/index_factura.php" />
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
                <td><input type="search" id="no_rad_search" placeholder="Rad" class="search_txt" size="4" /></td>
                <td><input type="search" id="fecha_rad_search" placeholder="Buscar x fecha" class="search_txt fecha" /></td>
                <td><input type="search" id="factura_search" placeholder="Buscar x No. Factura" class="search_txt" /></td>
                <td></td>
                <td><input type="search" id="proveedor_search" placeholder="Buscar x proveedor" class="search_txt" /></td>
                <td><input type="search" id="paciente_search" placeholder="Buscar x paciente" class="search_txt" /></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th title="No. Radicado">RAD</th>
                <th title="Fecha Radicación">FECHA RAD.</th>
                <th>NO. FACTURA</th>
                <th>VALOR</th>
                <th>PROVEEDOR</th>
                <th>PACIENTE</th>
                <th>ESTADO</th>
                <th>AUD. FINANCIERA</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista">
            <? $i=1; 
            foreach ($dataFacturas as $fac) {
                $rs_au=$auMedica->getOne(0,$fac['idf']);
                ?>
            <tr class="elemetoBusqueda">
                <td><?=$fac['no_radicado']?></td>
                <td><?=$fac['fecha_radicacion']?></td>
                <td><?=(($fac['prefijo']!="")?$fac['prefijo'].' ':'').$fac['numero_factura']?></td>
                <td><?=$fac['valor']?></td>
                <td><?=$fac['proveedor_nombre']?></td>
                <td><?=$fac['paciente_nombre']?></td>
                <td><?=($fac['estado_factura']==1)?'Activa':'Anulada'?></td>
                <td>
                   <?=($fac['audFinanciera']>0)?'OK':'Pendiente'?>
                </td>
                <? if(empty($rs_au)): ?>
                <td>
                    <a>
                        <span class="adicionarBtn" onclick="_addAuditoria(<?=$fac['idFactura']?>)"></span>
                    </a>
                </td>
                <? else:?>
                <td>
                    <a>
                        <span class="verBtn" onclick="_edit(<?=$fac['idFactura']?>)"></span>
                    </a>
                </td>
                <? endif?>
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
<script type="text/javascript" src="radicacion/js/factura.js"></script>