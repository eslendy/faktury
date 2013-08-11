<?php
include("usuarios/clases/usuarios_class.php");
$users = new usuarios($conexion['local']);
$dataUsers = $users->getallUsers();

include '../requestFunctionsJavascript.php';
//var_dump($dataUsers);
?>

<div class="collapse in" id="content_">

    <div class="table-option clearfix">

        <span class="pull-left keywords">

            <input name="q" class="table-form search-box" type="text"  placeholder="Description" >
            <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action'] ?>"> <i class="icon-search icon-white"></i></button>

            <div class="busqueda-radio" style="display: none;">
                <h4>Filtrar por:</h4>

                <label class="pull-left" for="description">Descripcion:</label> <input type="radio" name="type" value="descripcion" id="descripcion" class="search-radio" data-related="Descripcion" checked>
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

    <div id="contenedor" class="span12 pull-left">
       

        <div id="contenido">
            <table id="reporte" class="responsive table table-striped table-hover">
                <thead>
                   
                    <tr>
                        <th width="5%">ITEM</th>
                        <th width="30%">NOMBRES</th>
                        <th width="30%">APELLIDOS</th>
                        <th width="20%">EMAIL</th>
                        <th width="5%">ESTADO</th>
                        <th width="5%">EDITAR</th>
                        <th width="5%">PERFILES</th>
                    </tr>
                </thead>
                <tbody id="lista" class="loadContentFromSearch">
                    <? $i = 1;
                    foreach ($dataUsers as $usr) {
                        ?>
                        <tr class="elemetoBusqueda">
                            <td width="5%"><?= $i++ ?></td>
                            <td><?= $usr['nombres'] ?></td>
                            <td><?= $usr['apellidos'] ?></td>
                            <td><?= $usr['email'] ?></td>
                            <td><?= ($usr['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                            
                            <td width="30">
                                <a class="btn btn-danger" onclick="_editarReg(<?= $usr['idusuarios'] ?>)">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                            <td width="30">
                                <a class="perfilBtn btn btn-primary" onclick="_addPerfil(<?= $usr['idusuarios'] ?>)">
                                    <i class="icon-group"></i>
                                </a>
                            </td>
                            
                           
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
    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>usuarios/js/usuarios.js"></script>
    <script type="text/javascript">var init =<?php echo json_encode(Page::loadVars()) ?></script>  

    <div class="clear"></div>
</div>
