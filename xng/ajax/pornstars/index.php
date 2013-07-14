<?php
include('../../../admin/db.php');
 error_reporting(E_ALL | E_STRICT);
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1); 
include '../../lib/bootstrap.php';

$Videos = new \Masturbate\Data\VideoRepository();
$Pornstars = new \Masturbate\Data\PornStarRepository();

$HTML = array();
$Params = array();
$HTML['html'] ='';
$letter = '';
$search = '';
$sortby = '';

$data = array();
$data['totalItemsByRequest'] = $pornstar_results_per_page;
foreach ($_REQUEST as $key => $value) {
    if ($value) {
        $data[$key] = $value;
    } else {
        $data[$key] = '';
    }
}
$data['ip'] = $_SERVER['REMOTE_ADDR'];

if(isset($data['letter'])){
    $letter = $data['letter'];
}
if(isset($data['search'])){
    $search = $data['search'];
}
if(isset($data['sortby'])){
    $sortby = $data['sortby'];
}

$next = ($data['page']*$data['totalItemsByRequest'])-$data['totalItemsByRequest'];

$PornStarList = $Pornstars->findPaginatedTopPornStars($data['totalItemsByRequest'], $next, $letter, $search, $sortby);
$end = end($PornStarList);
$total = count($PornStarList);
$Params['data'] = $PornStarList;
$Params['basehttp'] = $basehttp;
$Params['misc_url'] = $misc_url;
$Params['Pornstars'] = $Pornstars;
if(isset($data['type']) && $data['type']=='mobile'){
    $HTML['html'] .= Page::getContentHtml('html_load_more_pornstars_mobile.php', $Params);
}
else{
    $HTML['html'] .= Page::getContentHtml('html_load_more_pornstars.php', $Params);
}
$HTML['page'] = $data['page'];
$HTML['last_pornstar_load'] = $end['record_num'];
$HTML['last_pornstar'] = $data['last_pornstar'];
$haveMore = true;
if($total < $data['totalItemsByRequest']){
    $haveMore = false;
}
$HTML['haveMore'] = $haveMore;

die(json_encode($HTML));