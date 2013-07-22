<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/fuerza_class.php");
$obj = new fuerza($conexion['local']);
$data = $obj->getallFuerzas();
//var_dump($dataUsers);

include '../requestFunctionsJavascript.php';
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
    <input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME ?>radicacion/index_fuerza.php" />


    <div id="contenido">
        <table id="reporte" class="responsive table">
            <thead>
                <? /* <tr id="trBuscar" class="oculto">
                  <td></td>
                  <td><input type="search" id="descripcion_search" placeholder="Buscar x Descripcion" class="search_txt" /></td>
                  <td><input type="search" id="abreviatura_search" placeholder="Buscar x abreviatura" class="search_txt" /></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr> */ ?>
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
                <?
                $i = 1;
                foreach ($data as $u) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $u['idfuerza'] ?></td>
                        <td><?= $u['descripcion'] ?></td>
                        <td><?= $u['abreviatura'] ?></td>
                        <td><?= ($u['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                        <td width="61">
                            <a>
                                <span class="editarBtn" data-record="<? echo  $u['idfuerza']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="61">
                            <a>
                                <span class="anularBtn" data-record="<? echo  $u['idfuerza']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
                            </a>
                        </td>
                    </tr>
<? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" id="pager" class="holder" align="center">

                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/fuerza.js"></script>
</div>