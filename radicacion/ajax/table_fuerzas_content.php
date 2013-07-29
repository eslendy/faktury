<?
$i = 1;
if (!empty($dataFuerzas)) {
    foreach ($dataFuerzas as $u) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $u['idfuerza'] ?></td>
            <td><?= $u['descripcion'] ?></td>
            <td><?= $u['abreviatura'] ?></td>
            <td><?= ($u['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $u['idfuerza']; ?>" data-section="radicacion" data-action="fuerza"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $u['idfuerza']; ?>" data-section="radicacion" data-action="fuerza"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
                </a>
            </td>
        </tr>
    <? }
} else {
    ?>
    <tr class="elemetoBusqueda">
        <td colspan="9" align="center">
            <b><em>No hay registros para tu busqueda.</em></b>
        </td>
    </tr>
    <? }
?> 


<script type="text/javascript" src="<? echo $SERVER_NAME ?>js/jGeneral.js"></script>