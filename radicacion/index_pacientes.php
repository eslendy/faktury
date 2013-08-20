<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("clases/paciente_class.php");
$obj = new paciente($conexion['local']);
$data = $obj->getallPacientes();
//var_dump($dataUsers);

include '../requestFunctionsJavascript.php';
?>
<div class="collapse in" id="content_">
    <div class="table-option clearfix">

        
        
         <span class="pull-left keywords">
           
                <input name="q" class="table-form search-box" type="text"  placeholder="Documento" >
                <button type="submit" class="btn btn-primary search-btn" data-case="<? echo $_REQUEST['action']?>"> <i class="icon-search icon-white"></i></button>
                <h4>Filtrar por:</h4>
                <div class="busqueda-radio">
                    <label class="pull-left" for="documento">Documento:</label><input type="radio" name="type" value="p.documento" id="documento" class="search-radio" data-related="Documento" checked>
                    <label class="pull-left" for="nombre">Nombre:</label><input type="radio" name="type" value="p.nombre" id="nombre" class="search-radio" data-related="Nombre">
                    <label class="pull-left" for="apellido">Apellido:</label><input type="radio" name="type" value="p.apellidos" id="apellido" class="search-radio" data-related="Apellido">
                    <label class="pull-left" for="fuerza">Fuerza:</label><input type="radio" name="type" value="f.descripcion" id="fuerza" class="search-radio" data-related="Fuerza">
                </div>
         
            <script>
                $(document).ready(function(){
                    $('.checked .search-radio').click(function(){
                        $('.search-box').attr('placeholder', $(this).attr('data-related'));
                    })
                })
            </script>
        </span>
     
        <div class="clear"></div>


    </div>
    <input type="hidden" id="nombre_archivo" value="/radicacion/index_pacientes.php" />

    <div id="contenido">
        <table id="reporte" class="responsive table table-striped table-hover">
            <thead>
               
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>FUERZA</th>
                    <th>ESTADO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista" class="loadContentFromSearch">
                <? $i = 1;
                foreach ($data as $d) {
                    ?>
                    <tr class="elemetoBusqueda">
                        <td><?= $d['idpaciente'] ?></td>
                        <td><?= $d['desTipod'] . ' ' . $d['documento'] ?></td>
                        <td><?= $d['nombre'] ?></td>
                        <td><?= $d['apellidos'] ?></td>
                        <td><?= $d['desFuerza'] ?></td>
                        <td><?= ($d['estadoPaciente'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                        <td width="20">
                            <a>
                                <span class="editarBtn" data-record="<? echo  $d['idpaciente']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                            </a>
                        </td>
                        <td width="20">
                            <a>
                                <span class="anularBtn" data-record="<? echo  $d['idpaciente']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-info"><i class="icon-ban-circle"></i></button></span>
                            </a>
                        </td>
                        <? /* <td width="20">
                            <a>
                                <span class="removeBtn" data-record="<? echo  $d['idpaciente']; ?>" <? echo (($_REQUEST['section']))?'data-section="'.$_REQUEST['section'].'"':'';?> <? echo (($_REQUEST['action']))?'data-action="'.$_REQUEST['action'].'"':'';?>><button class="btn btn-danger"><i class="icon-remove"></i></button></span>
                            </a>
                        </td> */ ?>
                    </tr>
<? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" id="pager" class="holder" align="center">

                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <script type="text/javascript" src="<? echo $SERVER_NAME ?>radicacion/js/paciente.js"></script>
</div>