<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/auditoria_financiera.php");
    $auditoria = new auditoria_financiera($conexion['local']);
    $data = $auditoria->getAll("f.estado=1".(( isset($_GET['idfactura'])&& $_GET['idfactura']>0)?' AND au.idFactura='.$_GET['idfactura']:''));
	include '../requestFunctionsJavascript.php';
    //var_dump($dataFacturas);
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">
            <form action="#" class="form-inline">
                <input name="q" class="table-form" type="text"  placeholder="Keywords: Ruby, Rails, Django" >
                <button type="submit" class="btn btn-primary"> <i class="icon-search icon-white"></i></button>
            </form>
        </span>
     
        <div class="clear"></div>


    </div>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME; ?>auditoria_financiera/index_auditoria" />


<div id="contenido">
    <table id="reporte" class="responsive table">
        <thead>
           
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
                <td width="61">
                    <a>
                        <span class="editarBtn" data-record="<? echo $fac['idfactura']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?> data-auditor="<? echo $fac['idauditoria_financiera'] ?>"  title="Editar Auditoría"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                    </a>
                </td>
                <td width="61">
                    <a>
                        <span class="anularBtn" data-record="<? echo $fac['idauditoria_financiera']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?>  <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?> title="Anular auditoría"><button class="btn btn-danger"><i class="icon-ban-circle"></i></button></span>
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
<script type="text/javascript" src="<? echo $SERVER_NAME; ?>auditoria_financiera/js/auditoria_financiera_lista.js"></script>
</div>