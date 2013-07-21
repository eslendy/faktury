<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/usuarios_class.php');
include('../../perfiles/clases/perfiles_class.php');
$perfil = new perfil($conexion['local']);
$usuario = new usuarios($conexion['local']);
$dataP = $perfil->getallPerfiles();
$data = $usuario->getUser($_POST['idusuarios']);
$dataUp = $usuario->getPerfil($_POST['idusuarios']);
?>

<form id="frmUsuario" class="formulario">
    <input type="hidden" name="idusuarios" id="idusuarios" value="<?= $data['idusuarios'] ?>" />
    <table class="responsive table">
        <thead>
            <tr>
                <th colspan="2"><div id="mensaje"></div></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><label>Usuario: </label></td>
                <td><?= ($data['userName']) ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="responsive table">
                        <thead>

                        </thead>

                        <tbody>
                            <tr>
                                <td>Perfiles</td>
                                <td>
                                    <select name="idperfil" class="validate[required]">
                                        <option>Seleccione</option>
                                        <? foreach ($dataP as $perf) { ?>
                                            <option value="<?= $perf['idperfil'] ?>" <?= ($dataUp['idperfil'] == $perf['idperfil']) ? 'selected="selected"' : '' ?>><?= $perf['descripcion'] ?></option>
                                        <? } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</form>