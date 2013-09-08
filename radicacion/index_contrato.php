<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/contrato_class.php");
$obj = new contrato($conexion['local']);
if(empty($_REQUEST['page'])){
  $_REQUEST['page'] = 1;  
}
$data = $obj->getallByPage($_REQUEST['page']);
include '../requestFunctionsJavascript.php';
//var_dump($dataUsers);
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="Numero de Contrato" >
            <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action'] ?>"> <i class="icon-search icon-white"></i></button>
            <h4>Filtrar por:</h4>
            <div class="busqueda-radio">
                <label class="pull-left" for="nro-contrato">Numero de Contrato:</label> <input type="radio" name="type" value="c.numero_contrato" id="nro-contrato" class="search-radio" data-related="Numero de Contrato" checked>
                <label class="pull-left" for="fecha">Fecha Contrato:</label><input type="radio" name="type" value="c.fecha_contrato" id="fecha" class="search-radio" data-related="Fecha Contrato">
                <label class="pull-left" for="proveedor">Proveedor:</label><input type="radio" name="type" value="p.nombre" id="proveedor" class="search-radio" data-related="Proveedor">
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


    <input type="hidden" id="nombre_archivo" value="/radicacion/index_contrato" />

    <div id="contenido">
        <table id="reporte" class="responsive table table-striped table-hover">
            <thead>

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
            <tbody id="lista" class="loadContentFromSearch">
                <? $i = 1;
                foreach ($data['data'] as $d) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $d['numero_contrato'] ?></td>
                        <td><?= $d['fecha_contrato'] ?></td>
                        <td><?= $d['valor_contrato'] ?></td>
                        <td><?= $d['proveedor'] ?></td>
                        <td><?= ($d['estadoContrato'] == 1) ? '<strong class="label label-success">Activo</strong>' : '<strong class="label label-danger">Inactivo</strong>' ?></td>
                        <td width="20">
                            <a>
                                <span class="editarBtn" data-record="<? echo $d['idcontrato']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="20">
                            <a>
                                <span class="anularBtn" data-record="<? echo $d['idcontrato']; ?>" <? echo (($_REQUEST['section'])) ? 'data-section="' . $_REQUEST['section'] . '"' : ''; ?> <? echo (($_REQUEST['action'])) ? 'data-action="' . $_REQUEST['action'] . '"' : ''; ?>><button class="btn btn-info"><i class="icon-ban-circle"></i></button></span>
                            </a>
                        </td>
                        <? /*  <td width="20">
                          <a>
                          <span class="removeBtn" data-record="<? echo  $d['idcontrato']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-remove"></i></button></span>
                          </a>
                          </td> */ ?>
                    </tr>
                <? } ?>
            </tbody>
            
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/contrato.js"></script>
</div>
<script>
    var page_total = <?php echo ($data['total'] > 1) ? $data['total'] : 1; ?>;
    createPaginated(<?php echo $_REQUEST['page']; ?>, page_total, '<? echo $_REQUEST['section'] ?>');
</script>