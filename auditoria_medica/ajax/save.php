<?

include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

try {
    switch ($_REQUEST['type']) {
        case 'addAuditoria':
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