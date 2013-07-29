<?php
    include("../vigiaAjax.php");
    include("../libphp/config.inc.php");
    include("../libphp/mysql.php");
    include("clases/udAtencion_class.php");
    $unds = new undidad_atencion($conexion['local']);
    $dataUnds = $unds->getallUnidades();
    //var_dump($dataUsers);
   include '../requestFunctionsJavascript.php';
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">
                <input name="q" class="table-form search-box" type="text"  placeholder="Descripcion" >
                <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action']?>"> <i class="icon-search icon-white"></i></button>
                <h4>Filtrar por:</h4>
                <div class="busqueda-radio">
                    <label class="pull-left" for="description">Descripcion:</label> <input type="radio" name="type" value="descripcion" id="descripcion" class="search-radio" data-related="Descripcion" checked>
                </div>
         
            <script>
                $(document).ready(function(){
                    $('.checked .search-radio').click(function(){
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                    })
                })
            </script>
        </span>
        
        <div class="clear"></div>


    </div>
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_unidadAtencion" />


<div id="contenido">
    <table id="reporte" class="responsive table table-striped table-hover">
        <thead>
           
            <tr>
                <th>ID</th>
                <th>DESCRIPCION</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="lista" class="loadContentFromSearch">
            <? $i=1; 
            foreach ($dataUnds as $u) {?>
            <tr class="elemetoBusqueda">
                <td><?=$u['idunidad_atencion']?></td>
                <td><?=$u['descripcion']?></td>
                <td><?=($u['estado']==1)?'Activo':'Inactivo'?></td>
                <td width="61">
                    <a>
                        <span class="editarBtn" data-record="<? echo  $u['idunidad_atencion']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                    </a>
                </td>
                <td width="61">
                    <a>
                        <span class="anularBtn" data-record="<? echo  $u['idunidad_atencion']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
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
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/unidadesAtencion.js"></script>
</div>