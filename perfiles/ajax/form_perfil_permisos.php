<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/perfiles_class.php');
include('../../modulos/clases/modulo_class.php');
$perfiles = new perfil($conexion['local']);
$modulos = new modulo($conexion['local']);
$data = $perfiles->getPerfil($_POST['idperfil']);
$dataModulos = $modulos->getallModulos();
?>

<form id="frmPerfil" class="formulario">
	<input type="hidden" name="idperfil" id="idperfil" value="<?=$data['idperfil']?>" />
	<table class="responsive table ">
		<thead>
			<tr>
				<th colspan="2"><div id="mensaje"></div></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="center"><label>Perfil: <?=$data['descripcion']?></label></td>
			</tr>
			
			<tr>
				<td><label>Permisos</label></td>
				<td>
					<table class="responsive table">
						<thead>
							<tr>
								<th colspan="2">MODULO</th>
								<th>VER</th>
								<th>AÑADIR</th>
								<th>EDITAR</th>
								<th>ANULAR</th>
							</tr>
						</thead>
						<tbody>
						<? foreach ($dataModulos as $mod ) { 
							$perm=$perfiles->getPermisosXPerfil($data['idperfil'],$mod['idmodulo']);
							$check = ($perm['borrar']==1 || $perm['editar']==1 || $perm['ver']==1 || $perm['add']==1)?1:0;
						?>
							<tr>
								<td>
									<input type="checkbox" name="idmodulo[]" value="<?=$mod['idmodulo']?>" onclick="_verPermisos(this)" class="validate[required]" <?=($check==1)?'checked="checked"':''?>>
								</td>
								<td><?=$mod['descripcion']?></td>
								<td <?=($check==0)?'style="display:none;"':''?> class="td_<?=$mod['idmodulo']?>" align="center">
									<input type="checkbox" name="per_<?=$mod['idmodulo']?>[]" value="ver" <?=($perm['ver']==1)?'checked="checked"':''?> class="validate[required]">
								</td>
								<td <?=($check==0)?'style="display:none;"':''?> class="td_<?=$mod['idmodulo']?>" align="center">
									<input type="checkbox" name="per_<?=$mod['idmodulo']?>[]" value="add" <?=($perm['add']==1)?'checked="checked"':''?> class="validate[required]">
								</td>
								<td <?=($check==0)?'style="display:none;"':''?> class="td_<?=$mod['idmodulo']?>" align="center">
									<input type="checkbox" name="per_<?=$mod['idmodulo']?>[]" value="edi" <?=($perm['editar']==1)?'checked="checked"':''?> class="validate[required]">
								</td>
								<td <?=($check==0)?'style="display:none;"':''?> class="td_<?=$mod['idmodulo']?>" align="center">
									<input type="checkbox" name="per_<?=$mod['idmodulo']?>[]" value="del" <?=($perm['borrar']==1)?'checked="checked"':''?> class="validate[required]">
								</td>
							</tr>
						<? } ?>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<input type="hidden" id="nombre_archivo" value="/perfiles/index_perfil.php" />


<script>
    $('.guardar-formulario.permisos').submit(function(e) {
        $.preventDefault(e);

    })
    $('.guardar-formulario.permisos').click(function(e) {

        if ($('#frmPerfil').validationEngine('validate') == true) {
            $.post(init.XNG_WEBSITE_URL + 'perfiles/ajax/save.php?type=addPermisos', $('#frmPerfil').serialize(), function(data) {
                console.log('entra: ' + data);
                switch (data) {
                    case '1':
                        alert("Permisos Editados con Éxito!!");
                        _loadContenido($('#nombre_archivo').val());
                        $('.modal').modal('hide')
                        $('.guardar-formulario').removeClass('permisos');
                        break;
                    default:
                        _msgerror(data, "#mensaje");
                        break;
                }
            })
        }

    })
</script>