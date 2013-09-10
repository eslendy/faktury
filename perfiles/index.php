<?php
include("perfiles/clases/perfiles_class.php");
$perfiles = new perfil($conexion['local']);
$dataPerfil = $perfiles->getallPerfiles();
include '../requestFunctionsJavascript.php';
//var_dump($dataUsers);
?>

<div class="collapse in" id="content_">

    <div class="table-option clearfix">

     

        <div class="clear"></div>


    </div>

    <div id="contenedor" class="span12 pull-left">

        <div id="contenido">
            <table id="reporte" class="responsive table table-striped table-hover">
                <thead>

                    <tr>
                        <th width="5%">ITEM</th>
                        <th width="75%">DESCRIPCIÓN</th>
                        <th width="10%">ESTADO</th>
                        <th width="10%">EDITAR</th>
                        <th width="10%">PERMISOS</th>
                    </tr>
                </thead>
                <tbody id="lista" class="loadContentFromSearch">
                    <?
                    $i = 1;
                    foreach ($dataPerfil as $per) {
                        ?>
                        <tr class="elemetoBusqueda">
                            <td width="5%"><?= $i++ ?></td>
                            <td><?= $per['descripcion'] ?></td>
                            <td><?= ($per['estado'] == 1) ? '<strong class="label label-success">Activo</strong>' : '<strong class="label label-danger">Inactivo</strong>' ?></td>
                            <td width="30">
                                <a class="btn btn-danger" onclick="_editarReg(<?= $per['idperfil'] ?>)">
                                    <i class="icon-edit"></i>
                                </a>
                            </td>
                            <td width="30">
                                <a class="permisosBtn btn btn-primary" onclick="_asigPermisos(<?= $per['idperfil'] ?>)">
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
    <div class="clear"></div>
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>perfiles/js/perfil.js"></script>
</div>
