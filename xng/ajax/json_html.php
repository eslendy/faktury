<?php
session_start();
$params = array();
$url = 'http://' . $_SERVER['SERVER_NAME'] . '/';
if ($_REQUEST) {
	if ($_REQUEST['add_gallery'] && $_REQUEST['params']) {

		$params = $_REQUEST['params'];

		$result['html'] = '<li class="span3">
		<span class="remove_"><i class="icon-remove icon-white"></i></span>
		<a href="' . $url . $_SESSION['userid'] . '/galleries/' . $params['id'] . '" class="thumbnail gallery_item gallery_ajax_' . $params['id'] . '" rel="gallery_' . $params['id'] . '">
			<img style="width: 200px; height: 200px; " src="">
			<h3 class="gallery_' . $params['id'] . '" style="display: block; "><span class="name_gallery_hover">' . $params['gallery_name'] . '</span><br><span class="white">0 Pics</span></h3>
		</a>
</li>';
		$result['status'] = 'success';
		$result['id'] = $params['id'];
		$result['url'] = $url . 'user/' . $_SESSION['userid'] . '/galleries/' . $params['id'];
		die(json_encode(array('result' => $result)));
	}
} else {
	die('no data');
}
?>
