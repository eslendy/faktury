<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../classes/reportes_class.php");
$Reportes = new reportes($conexion['local']);

$date = explode('-', $_REQUEST['dateToSearch']);

if ($_REQUEST['mode'] == 'days') {
    if (strlen($date[2]) == 1) {
        $date[2] = '0' . $date[2];
    }
    if (strlen($date[1])) {
        $date[1] = '0' . $date[1];
    }
}

if ($_REQUEST['mode'] == 'months') {
    if (strlen($date[1]) == 1) {
        $date[1] = '0' . $date[1];
    }
}


$_REQUEST['dateToSearch'] = $date[0] . '-' . $date[1] . '-' . $date[2];

if ($_REQUEST['mode'] == 'days') {
    $data_ = $Reportes->getTotalDineroByDaySelected($_REQUEST['dateToSearch']);
    foreach($data_['data'] as $key => $d){
        $data[$key] = $d;
    }
    if(!empty($data[0])){
        $data[0]['result'] = TRUE;
        die( json_encode($data[0]));
    }
    else{
        die('{"result":"FALSE"}');
    }
    
}