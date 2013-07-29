<?php
$i = 1;
if (!empty($dataProveedores)) {
    foreach ($dataProveedores as $d) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $d['idproveedor'] ?></td>
            <td><?= $d['desTipod'] . ' ' . $d['nodocumento'] . (($d['idtipo_doc'] == '2') ? ' - ' . $d['dv'] : '') ?></td>
            <td><?= $d['nombre'] ?></td>
            <td><?= ($d['estadoProveedor'] == 1) ? 'Activo' : 'Inactivo' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $d['idproveedor']; ?>" data-section="radicacion" data-action="proveedor"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $d['idproveedor']; ?>" data-section="radicacion" data-action="proveedor"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
                </a>
            </td>
        </tr>
        <?
    }
} else {
    ?>
    <tr class="elemetoBusqueda">
        <td colspan="9" align="center">
            <b><em>No hay registros para tu busqueda.</em></b>
        </td>
    </tr>
    <?
}?>

    <script type="text/javascript" src="<? echo $SERVER_NAME?>js/jGeneral.js"></script>