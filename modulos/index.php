<?php
include("modulos/clases/modulo_class.php");
$modulos = new modulo($conexion['local']);
$dataModulo = $modulos->getallModulos();
//var_dump($dataUsers);
?>
<div class="collapse in" id="content_">

    <div class="table-option clearfix">

       

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
                    </tr>
                </thead>
                <tbody id="lista" class="loadContentFromSearch">
                    <? $i = 1;
                    foreach ($dataModulo as $mod) {
                        ?>
                        <tr class="elemetoBusqueda">
                            <td width="5%"><?= $i++ ?></td>
                            <td><?= $mod['descripcion'] ?></td>
                            <td><?= ($mod['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                            <td width="10%">
                                <a class="btn btn-danger" onclick="_editarReg(<?= $mod['idmodulo'] ?>)" >
                                    <i class="icon-edit"></i>
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
    <script type="text/javascript" src="<? echo $SERVER_NAME; ?>modulos/js/modulo.js"></script>
</div>