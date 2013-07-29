<?php
$i = 1;
if (!empty($dataPacientes)) {
    foreach ($dataPacientes as $d) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $d['idpaciente'] ?></td>
            <td><?= $d['desTipod'] . ' ' . $d['documento'] ?></td>
            <td><?= $d['nombre'] ?></td>
            <td><?= $d['apellidos'] ?></td>
            <td><?= $d['desFuerza'] ?></td>
            <td><?= ($d['estadoPaciente'] == 1) ? 'Activo' : 'Inactivo' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $d['idpaciente']; ?>" data-section="radicacion" data-action="pacientes"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $d['idpaciente']; ?>" data-section="radicacion" data-action="pacientes"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
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
    <?
}?>
<script type="text/javascript" src="<? echo $SERVER_NAME?>js/jGeneral.js"></script>