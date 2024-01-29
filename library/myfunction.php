<?php
function url($path){
	return SITE_URL.$path;
}
function urlAction($path){
	return SITE_URL.'?action='.$path;
}
function asset($path){
	return RESOURCE_URL.$path;
}
// function redirect($r,$msg=''){
// 	if(!empty($msg)){
// 		$_SESSION['msg'] = $msg;
// 	}
// 	header('location:'.SITE_URL.'?action='.$r);
// 	die;
// }
function redirect($r,$response){
	if(!empty($response)){
		$_SESSION['flash'] = $response;
	}
	header('location:'.SITE_URL.'?action='.$r);
	die;
}

function sessionflush($msg){
	$_SESSION['msg'] = $msg;
}
function sessionClear($msg=''){
	if(!empty($msg)){
		// ($_SESSION['msg'] == $msg && isset($_SESSION['msg'])) ? unset($_SESSION['msg'] : '';
	}else{
		// (isset($_SESSION['msg'])) ? unset($_SESSION['msg'] : '';
	}
}	