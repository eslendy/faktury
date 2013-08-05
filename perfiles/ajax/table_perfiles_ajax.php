<?php
$i = 1;
foreach ($dataPerfil as $per) {
    ?>
    <tr class="elemetoBusqueda">
        <td width="5%"><?= $i++ ?></td>
        <td><?= $per['descripcion'] ?></td>
        <td><?= ($per['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
        <td width="10%">
            <a>
                <span class="editarBtn" onclick="_editarReg(<?= $per['idperfil'] ?>)"></span>
            </a>
        </td>
        <td width="10%">
            <a>
                <span class="permisosBtn" onclick="_asigPermisos(<?= $per['idperfil'] ?>)"></span>
            </a>
        </td>
    </tr>
<? } ?>