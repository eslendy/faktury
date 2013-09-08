<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/fuerza_class.php");
$obj = new fuerza($conexion['local']);
if(empty($_REQUEST['page'])){
  $_REQUEST['page'] = 1;  
}
$data = $obj->getallFuerzasByPage($_REQUEST['page']);
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
    <input type="hidden" id="nombre_archivo" value="/radicacion/index_fuerza" />


    <div id="contenido">
        <table id="reporte" class="responsive table table-striped table-hover">
            <thead>
               
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCION</th>
                    <th>ABREVIATURA</th>
                    <th>ESTADO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista" class="loadContentFromSearch">
                <?
                $i = 1;
                foreach ($data['data'] as $u) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $u['idfuerza'] ?></td>
                        <td><?= $u['descripcion'] ?></td>
                        <td><?= $u['abreviatura'] ?></td>
                        <td><?= ($u['estado'] == 1) ? '<strong class="label label-success">Activo</strong>' : '<strong class="label label-danger">Inactivo</strong>' ?></td>
                        <td width="20">
                            <a>
                                <span class="editarBtn" data-record="<? echo  $u['idfuerza']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="20">
                            <a>
                                <span class="anularBtn" data-record="<? echo  $u['idfuerza']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-info"><i class="icon-ban-circle"></i></button></span>
                            </a>
                        </td>
                        <? /*
                         <td width="20">
                            <a>
                                <span class="removeBtn" data-record="<? echo  $u['idfuerza']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-remove"></i></button></span>
                            </a>
                        </td> */ ?>
                    </tr>
<? } ?>
            </tbody>
           
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/fuerza.js"></script>
</div>
<script>
    var page_total = <?php echo ($data['total'] > 1) ? $data['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['section'] ?>');
</script>