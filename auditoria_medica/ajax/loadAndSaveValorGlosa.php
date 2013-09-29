<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");

include("../clases/auMedica_class.php");
$auMedica = new auMedica($conexion['local']);

$saving = $auMedica->saveGlosaValue($_REQUEST);

if($saving)
{
    $data_ = $auMedica->getAllListsGlosasByFacturaId($_REQUEST['id_factura']);

}


$result['html'] = "<table class='responsive table table-hover'>
    <tbody>";
        foreach ($data_ as $data){
             switch ($data['step']) {
                            case 0:
                                $Glosa_Step = 'Glosa Inicial';
                                break;
                            case 1:
                                $Glosa_Step = 'Primera respuesta de Glosa';
                                break;
                            case 2:
                                $Glosa_Step = 'Segunda respuesta de Glosa';
                                break;
                            case 3:
                                $Glosa_Step = 'Glosa de conciliacion';
                                break;


                            default:
                                break;
                        }
       $result['html'] .="<tr>
        <td>
             <h3> $Glosa_Step </h3>
             <h5>Glosa ID #$data[id]</h5>
             <p><b>Valor: </b> $data[valor] </p>
             <p><b>Descripcion: </b> $data[descripcion] </p>
        </td>
    </tr>";
         }
$result['html'] .="</tbody>
</table>";
$result['valor'] = $_REQUEST['valor'];
die(json_encode($result));