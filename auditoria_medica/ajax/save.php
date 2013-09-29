<?

include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

try {
    switch ($_REQUEST['type']) {
        case 'addAuditoria':
            $bd->ejecutarInsertArray($_POST, "auditoria_medica");
            echo "1";
            break;
        case 'editAuditoria' :
            $bd->ejecutarUpdateArray($_POST, "auditoria_medica", "idauditoria_medica=" . $_POST['idauditoria_medica']);
            echo "1";
            break;
        case 'addNewGlosa' :
            $bd->ejecutarInsertArrayExistsUpdate($_POST, "glosa_auditoria", "select * from glosa_auditoria where auditoria_glosa = $_POST[auditoria_glosa] and step_glosa=$_POST[step_glosa]","auditoria_glosa=" . $_POST['auditoria_glosa']." and step_glosa= $_POST[step_glosa] ");

            /*$bd->ejecutarInsertArray($_POST, "glosa_auditoria");*/
            echo "1";
            break;
        case 'nullauditoria_medica' :
            $bd->ejecutarBorrar("auditoria_medica", "idauditoria_medica=".$_POST['id']);
            echo "1";
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>