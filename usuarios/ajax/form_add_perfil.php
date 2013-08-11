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
</form>

<input type="hidden" id="nombre_archivo" value="/usuarios/index_usuarios.php" />


<script>
    $('.guardar-formulario.addperfiltouser').submit(function(e) {
        $.preventDefault(e);

    })
    $('.guardar-formulario.addperfiltouser').click(function(e) {

        if ($("#frmUsuario").validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'usuarios/ajax/save.php?type=addPerfil', $("#frmUsuario").serialize(), function(data) {
                console.log('entra: ' + data);
                switch (data) {
                    case '1':
                        alert("Agregado perfil a usuario con Éxito!!");
                        _loadContenido($('#nombre_archivo').val());
                        $('.modal').modal('hide')
                        $('.guardar-formulario').removeClass('addperfiltouser');
                        break;
                    default:
                        _msgerror(data, "#mensaje");
                        break;
                }
            })
        }

    })
</script>