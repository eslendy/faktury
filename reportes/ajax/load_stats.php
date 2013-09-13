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

if (!empty($date[1])) {
    $_REQUEST['dateToSearch'] = $date[0] . '-' . $date[1] . '-' . $date[2];
}

$auditores = $Reportes->getTotalAuditors();

foreach ($auditores['data'] as $key => $value){
    $value[$key]['nombre'] = $value['nombres'].' '.$value['apellidos'];
    $value['ids'][] = $value['idusuarios'];
}

$ids = implode(',', $value['ids']);

$facturas_auditor = $Reportes->getTotalFacturasByAuditors($ids);

//var_dump($facturas_auditor);

if ($_REQUEST['mode'] == 'days') {
    $data_ = $Reportes->getTotalDineroByDaySelected($_REQUEST['dateToSearch']);
    foreach ($data_['data'] as $key => $d) {
        $data[$key] = $d;
    }
    $data_ = $Reportes->getTotalFacturasByDaySelected($_REQUEST['dateToSearch']);

    foreach ($data_['data'] as $key => $d) {
        $data[0]['TOTAL_FACTURAS_BY_DAY'][$key] = $d;
    }
    if (($data[0]['TOTAL_FACTURAS_BY_DAY'][0]['total']>0)) {
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
        $data__['TOTAL_MONTH_DEATAILED'][$day_key] = $d;
    }


    for ($i = 1; $i < ($num + 1); $i++) {
        if ($i == $data__['TOTAL_MONTH_DEATAILED'][$i]['DAY_NUMBER']) {
            $data['TOTAL_MONTH_DEATAILED'][$i] = $data__['TOTAL_MONTH_DEATAILED'][$i];
        } else {
            $data['TOTAL_MONTH_DEATAILED'][$i]['DAY_NUMBER'] = $i;
            $data['TOTAL_MONTH_DEATAILED'][$i]['DAY_NAME'] = 'Dia ' . $i;
            $data['TOTAL_MONTH_DEATAILED'][$i]['total'] = 0;
        }

        /* } */
    }

    $data_ = $Reportes->getTotalDineroByMonthSelected($_REQUEST['dateToSearch']);
    foreach ($data_['data'] as $key => $d) {
        $data['TOTAL_MONTH'][$key] = $d;
    }

    $data_ = $Reportes->getTotalFacturasByMonthSelected($_REQUEST['dateToSearch']);

    foreach ($data_['data'] as $key => $d) {
        $data['TOTAL_FACTURAS_BY_MONTH'][$key] = $d;
    }
    
    if (!empty($data)) {
        $data['result'] = TRUE;
        die(json_encode($data, TRUE));
    } else {
        die('{"result":"FALSE"}');
    }
}

if ($_REQUEST['mode'] == 'years') {
    $data_ = $Reportes->getTotalDineroByMonthYearsSelected($_REQUEST['dateToSearch']);
    
    var_dump($data_);
    $num = 12;

    $data['result'] = true;
    $data__ = array();
    foreach ($data_['data'] as $key => $d) {
        $month_key = $d['MONTH_NUMBER'];
        $data__['TOTAL_YEAR_DEATAILED'][$month_key] = $d;
    }


    for ($i = 1; $i < ($num + 1); $i++) {
        if ($i == $data__['TOTAL_YEAR_DEATAILED'][$i]['MONTH_NUMBER']) {
            $data['TOTAL_YEAR_DEATAILED'][$i] = $data__['TOTAL_YEAR_DEATAILED'][$i];
        } else {
            $data['TOTAL_YEAR_DEATAILED'][$i]['MONTH_NUMBER'] = $i;
            $data['TOTAL_YEAR_DEATAILED'][$i]['MONTH_NAME'] = 'Mes ' . $i;
            $data['TOTAL_YEAR_DEATAILED'][$i]['total'] = 0;
        }

        /* } */
    }

    $data_ = $Reportes->getTotalDineroByYearSelected($_REQUEST['dateToSearch']);

    foreach ($data_['data'] as $key => $d) {

        $data['TOTAL_YEAR'][$key] = $d;
    }
    
    $data_ = $Reportes->getTotalFacturasByYearSelected($_REQUEST['dateToSearch']);

    foreach ($data_['data'] as $key => $d) {
        $data['TOTAL_FACTURAS_BY_YEAR'][$key] = $d;
    }
    
    if (!empty($data)) {
        $data['result'] = TRUE;
        die(json_encode($data, TRUE));
    } else {
        die('{"result":"FALSE"}');
    }
}