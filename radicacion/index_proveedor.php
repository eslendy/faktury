<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/proveedor_class.php");
$obj = new proveedor($conexion['local']);
if (empty($_REQUEST['page'])) {
    $_REQUEST['page'] = 1;
}
$data = $obj->getallProviderByPage($_REQUEST['page']);
//var_dump($dataUsers);
include '../requestFunctionsJavascript.php';
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">


        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="Documento" >
            <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action'] ?>"> <i class="icon-search icon-white"></i></button>
            <h4>Filtrar por:</h4>
            <div class="busqueda-radio">
                <label class="pull-left" for="documento">Documento:</label><input type="radio" name="type" value="p.nodocumento" id="documento" class="search-radio" data-related="Documento" checked>
                <label class="pull-left" for="nombre">Nombre:</label><input type="radio" name="type" value="p.nombre" id="nombre" class="search-radio" data-related="Nombre">
            </div>

            <script>
                $(document).ready(function() {
                    $('.checked .search-radio').click(function() {
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                    })
                })
            </script>
        </span>

        <div class="clear"></div>


    </div>
    <input type="hidden" id="nombre_archivo" value="/radicacion/index_proveedor" />


    <div id="contenido"> 
        <table id="reporte" class="responsive table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>ESTADO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista" class="loadContentFromSearch">
                <? $i = 1;
                foreach ($data['data'] as $d) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $d['idproveedor'] ?></td>
                        <td><?= $d['desTipod'] . ' ' . $d['nodocumento'] . (($d['idtipo_doc'] == '2') ? ' - ' . $d['dv'] : '') ?></td>
                        <td><?= $d['nombre'] ?></td>
                        <td><?= ($d['estadoProveedor'] == 1) ? '<strong class="label label-success">Activo</strong>' : '<strong class="label label-danger">Inactivo</strong>' ?></td>
                        <td width="20">
                            <a>
                                <span class="editarBtn" data-record="<? echo $d['idproveedor']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="20">
                            <a>
                                <span class="anularBtn" data-record="<? echo $d['idproveedor']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-info"><i class="icon-ban-circle"></i></button></span>
                            </a>
                        </td>

                        <? /*
                          <td width="20">
                          <a>
                          <span class="removeBtn" data-record="<? echo  $d['idproveedor']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-remove"></i></button></span>
                          </a>
                          </td> */ ?>
                    </tr>
<? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" id="pager" class="holder" align="center">

                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/proveedor.js"></script>
</div>
<script>
    var page_total = <?php echo ($data['total'] > 1) ? $data['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['action'] ?>');
</script>