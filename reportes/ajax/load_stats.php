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
    foreach ($data_['data'] as $key => $d) {
        $data[$key] = $d;
    }
    if (!empty($data[0])) {
        $data[0]['result'] = TRUE;
        die(json_encode($data[0]));
    } else {
        die('{"result":"FALSE"}');
    }
}

if ($_REQUEST['mode'] == 'months') {
    $data_ = $Reportes->getTotalDineroByDaysMonthSelected($_REQUEST['dateToSearch']);

    $num = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);

    $data['result'] = true;
$data__ = array();
    foreach ($data_['data'] as $key => $d) {
        $day_key = $d['DAY_NUMBER'];
        /*if(strlen($d['DAY_NUMBER'])==1){
            $d['DAY_NUMBER'] = '0'.$d['DAY_NUMBER'];
        }
        if(strlen($d['MONTH_NUMBER'])==1){
            $d['MONTH_NUMBER'] = '0'.$d['MONTH_NUMBER'];
        }*/
        /*if (strlen($day_key) == 1) {
            $day_key = '0' . $day_key;
        }*/
        $data__['TOTAL_MONTH_DEATAILED'][$day_key] = $d;
    }
    
    
    for ($i = 1; $i < ($num+1); $i++) {
        /* if (in_array($i, $data['TOTAL_MONTH_DEATAILED'][$i])) { */
        /*if (strlen($i) == 1) {
            $i = '0' . $i;
        }*/
        //echo $data['TOTAL_MONTH_DEATAILED'][$i]['DAY_NUMBER'];
        if ($i == $data__['TOTAL_MONTH_DEATAILED'][$i]['DAY_NUMBER']) {
            $data['TOTAL_MONTH_DEATAILED'][$i] = $data__['TOTAL_MONTH_DEATAILED'][$i];
        }
        else{
            $data['TOTAL_MONTH_DEATAILED'][$i]['DAY_NUMBER'] = $i;
            $data['TOTAL_MONTH_DEATAILED'][$i]['DAY_NAME'] = 'Dia '.$i;
            $data['TOTAL_MONTH_DEATAILED'][$i]['total'] = 0;
   
        }
        
        /* } */
    }
    
    $data_ = $Reportes->getTotalDineroByMonthSelected($_REQUEST['dateToSearch']);

    foreach ($data_['data'] as $key => $d) {

        $data['TOTAL_MONTH'][$key] = $d;
    }
    if (!empty($data)) {
        $data['result'] = TRUE;
        die(json_encode($data, TRUE));
    } else {
        die('{"result":"FALSE"}');
    }
}