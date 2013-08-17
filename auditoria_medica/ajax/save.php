<?

include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

try {
    switch ($_REQUEST['type']) {
        case 'addAuditoria':
            //var_dump($_REQUEST);
            
            $GlosasFields = array();
            $DevolucionesFields = array();
            $PagosFields = array();
            $DefaultFields = array();

            foreach ($_REQUEST as $key => $values) {
                    $haveGlosa = false;
                    $haveDefault = false;
                    $havePagos = false;
                    $haveDevoluciones = false;
            
                if (strpos($key, 'losa_')) {
                    $key = str_replace('glosa_', '', $key);
                    $haveGlosa = true;

                    $GlosasFields[$key] = $values;
                } else if (strpos($key, 'evoluciones_')) {
                    $key = str_replace('devoluciones_', '', $key);
                    $haveDevoluciones = true;
                   

                    $DevolucionesFields[$key] = $values;
                } else if (strpos($key, 'ago_')) {
                    $key = str_replace('pago_', '', $key);
                    $havePagos = true;
                    
                    $PagosFields[$key] = $values;
                    
                } else if (strpos($key, 'efault_')) {
                    $key = str_replace('default_', '', $key);
                    $haveDefault = true;
                    
                    $DefaultFields[$key] = $values;
                }
            }

            if ($haveDevoluciones) {
                $_REQUEST['iddevolucion'] = $bd->ejecutarInsertArray($DevolucionesFields, "glosas_devoluciones");
            }
            if ($havePagos && $DefaultFields) {
                $PagosFields['idFactura'] = $_REQUEST['default_idFactura'];
                $PagosFields['id_auditor'] = $_REQUEST['default_id_auditor'];
                //$_REQUEST['idpagos'] = $bd->ejecutarInsertArray($PagosFields, "pagos");
               $Fields = array_merge($PagosFields, $DefaultFields);
                $bd->ejecutarInsertArray($Fields, "auditoria_medica");
            }
            if ($haveGlosa) {
                // $GlosasFields
                $_REQUEST['idglosa'] = $bd->ejecutarInsertArray($GlosasFields, "glosas_auditoria");
            }


            $bd->ejecutarInsertArray($_POST, "auditoria_medica");
            //echo "1";
            break;
        case 'editUndAtencion' :
            $idunidad_atencion = $_POST['idunidad_atencion'];
            unset($_POST['idunidad_atencion']);
            $bd->ejecutarUpdateArray($_POST, "unidad_atencion", "idunidad_atencion=" . $idunidad_atencion);
            echo "1";
            break;
        case 'nullUndAtencion':
            $bd->ejecutarUpdateArray(array("estado" => 0), "unidad_atencion", "idunidad_atencion=" . $_POST['idunidad_atencion']);
            echo "1";
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>