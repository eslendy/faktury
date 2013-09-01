<?

//error_reporting(E_ALL);
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
try {
    switch ($_GET['type']) {
        case 'addContabilidad':
            $bd->ejecutarInsertArray($_POST, "contabilidad");
            echo "1";
            break;
        case 'editContabilidad' :
            $idcontabilidad = $_POST['idcontabilidad'];
            unset($_POST['idperfil']);
            $bd->ejecutarUpdateArray($_POST, "contabilidad", "idcontabilidad=" . $idcontabilidad);
            echo "1";
            break;
        case 'removeContabilidad':
            $idcontabilidad = $_POST['idcontabilidad'];
            $bd->ejecutarBorrar("contabilidad", "idcontabilidad=" . $idcontabilidad);
            echo "1";
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>