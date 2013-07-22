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
<input type="hidden" id="nombre_archivo" value="<? echo $SERVER_NAME?>radicacion/index_pacientes.php" />
<div id="operaciones"> 
	<table class="responsive table">
    	<thead>
        </thead>
        <tbody>
        	<tr>
            	<td>
                	<button class="busqueda btn btn-success">
                    	Buscar
                	</button>
                </td>
                <td>
                    <button class="nuevoReg btn btn-primary">
                        Nuevo Paciente
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="contenido">
    <table id="reporte" class="responsive table">
        <thead>
            <? /*<tr id="trBuscar" class="oculto">
                <td></td>
                <td><input type="search" id="doc_paciente_search" placeholder="Buscar x docuemnto" class="search_txt fecha" /></td>
                <td><input type="search" id="nombre_paciente_search" placeholder="Buscar x nombre" class="search_txt fecha" /></td>
                <td><input type="search" id="apellido_paciente_search" placeholder="Buscar x apellido" class="search_txt fecha" /></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>*/ ?>
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
        <tbody id="lista">
            <? $i=1; 
            foreach ($data as $d) {?>
            <tr class="elemetoBusqueda">
                <td><?=$d['idpaciente']?></td>
                <td><?=$d['desTipod'].' '.$d['documento']?></td>
                <td><?=$d['nombre']?></td>
                <td><?=$d['apellidos']?></td>
                <td><?=$d['desFuerza']?></td>
                <td><?=($d['estadoPaciente']==1)?'Activo':'Inactivo'?></td>
                <td>
                    <a>
                        <span class="editarBtn" onclick="_editarReg(<?=$d['idpaciente']?>)"></span>
                    </a>
                </td>
                <td>
                    <a>
                        <span class="anularBtn" onclick="_anularReg(<?=$d['idpaciente']?>)"></span>
                    </a>
                </td>
            </tr>
            <? }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" id="pager" class="holder" align="center">
                   
                </td>
            </tr>
        </tfoot>
    </table>
    
</div>
<script type="text/javascript" src="<? echo $SERVER_NAME?>radicacion/js/paciente.js"></script>