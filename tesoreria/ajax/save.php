<?

//error_reporting(E_ALL);
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
try {
    switch ($_GET['type']) {
        case 'addTesoreria':
            $bd->ejecutarInsertArray($_POST, "tesoreria");
            echo "1";
            break;
        case 'editTesoreria' :
            $idtesoreria = $_POST['idtesoreria'];
            unset($_POST['idperfil']);
            $bd->ejecutarUpdateArray($_POST, "tesoreria", "idtesoreria=" . $idtesoreria);
            echo "1";
            break;
        case 'removeTesoreria':
            $idtesoreria = $_POST['idtesoreria'];
            $bd->ejecutarBorrar("tesoreria", "idtesoreria=" . $idtesoreria);
            echo "1";
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>