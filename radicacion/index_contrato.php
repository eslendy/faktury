<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/contrato_class.php");
    $obj = new contrato($conexion['local']);
    $data = $obj->getall();
    include '../requestFunctionsJavascript.php';
    //var_dump($dataUsers);
    
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

  
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_contrato" />

<div id="contenido">
    <table id="reporte" class="responsive table table-striped table-hover">
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
                <td width="61">
                    <a>
                        <span class="editarBtn" data-record="<? echo  $d['idcontrato']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                    </a>
                </td>
                <td width="61">
                    <a>
                        <span class="anularBtn" data-record="<? echo  $d['idcontrato']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
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
</div>