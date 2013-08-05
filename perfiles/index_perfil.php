<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/perfiles_class.php");
$perfiles = new perfil($conexion['local']);
$dataPerfil = $perfiles->getallPerfiles();
include '../requestFunctionsJavascript.php';
?>
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
                    <td><?= ($per['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
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