<?php
include_once('constant.php');
//set controller in other side
// $submit_action = isset($_GET['submit_action']) ? $_GET['submit_action'] : '';
// switch($submit_action){
// 	case 'add_form' :
// 	include_once(url('controller/form-controller.php'));
// 	//header('location: '.SITE_URL.'?action=form');
// 	exit;
// break;
// }
include_once(DIR.'/layout/header.php');
include_once(DIR.'/layout/sidebar.php');
switch ($action){
	case 'controller':
		include_once('controller/form-controller.php');
	break;

	case 'home':

		include_once('action/analytical.php');

	break;
	case 'all_data':
		include_once('action/all_data.php');
	break;
	case 'form':
		include_once('action/add_data.php');
	break;
	default :
		include_once('action/analytical.php');
	break;



}


include_once(DIR.'/layout/footer.php');






?>