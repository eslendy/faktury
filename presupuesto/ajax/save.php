<?

//error_reporting(E_ALL);
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
try {
    switch ($_GET['type']) {
        case 'addPresupuesto':
            $bd->ejecutarInsertArray($_POST, "presupuesto");
            echo "1";
            break;
        case 'editPresupuesto' :
            $idpresupuesto = $_POST['idpresupuesto'];
            unset($_POST['idperfil']);
            $bd->ejecutarUpdateArray($_POST, "presupuesto", "idpresupuesto=" . $idpresupuesto);
            echo "1";
            break;
        case 'removePresupuesto':
            $idpresupuesto = $_POST['idpresupuesto'];
            $bd->ejecutarBorrar("presupuesto", "idpresupuesto=" . $idpresupuesto);
            echo "1";
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>