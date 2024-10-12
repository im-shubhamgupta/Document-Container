<?php
include_once('constant.php');
//set controller in other side
$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
switch($controller){	
	case 'auth_controller':
		include_once('controller/auth_controller.php');
	break;
	case 'google_auth_controller':
		include_once('controller/google_auth_controller.php');
	break;
}	
if(isset($_SESSION['login']) && $_SESSION['login']=='y'){
	switch($controller){	
		case 'auth_controller':
			include_once('controller/auth_controller.php');
		break;
		case 'form-controller':
			include_once('controller/form-controller.php');
		break;
		case 'doc_controller':
			include_once('controller/document_controller.php');
		break;
	}
}
//include_once('library/authentication.php');

if(!in_array(ACTION,array('get_ajax'))){ //when call ajax,it's no need to load header & sidebar
	include_once(DIR.'/layout/header.php');
	include_once(DIR.'/layout/sidebar.php');
}	

$enc = new encrypt_decrypt();

if(isset($_SESSION['login']) && $_SESSION['login']=='y'){
	switch (ACTION){
		// case 'login':
		// 	include_once('action/login.php');
		// break;
		case 'home':
		case 'dashboard': 
			include_once('action/analytical.php');
		break;
		case 'all_data':
		case 'add_data':
			include_once('action/all_data.php');
			include_once('action/add_data.php');
		break;          
		// case 'add_data':
		// 	include_once('action/add_data.php');
		// break;
		// case 'dynamic_data':
		// 	include_once('action/add_data.php');
		// 	include_once('action/all_data.php');
		// break;
		case 'add_document':
			include_once('action/mod_document.php');
		break;
		case 'all_document':
			include_once('action/all_document.php');
		break;
		case 'category':
			include_once('action/all_category.php');
		break;
		case 'project':
			include_once('action/all_projects.php');
		break;
		case 'users':
			include_once('action/all_users.php');
		break;
		case 'get_ajax':  //you can direct manage of files
			
			if(isset($_GET['get_ajax']) && !empty($_GET['get_ajax'])){ //chagne name index_ajax
				include_once('ajax/'.$_GET['get_ajax'].'.php');//ajaxHandller
			}else{
				die('ajax not found');
			}
			echo "resg45";
		break;
		default :
			if(isset($_GET['action']) && empty($_GET['action'])){
				die("no action found");
			}
			elseif(isset($_GET['action']) && !empty($_GET['action'])){
				die("Error 404");
			}
			else{
				include_once('action/analytical.php');
			}
		break;
	}
}else{
	include_once('action/login.php');
}
//ajax request no need to load footer
if(!in_array(ACTION,array('get_ajax'))){
	include_once(DIR.'/layout/footer.php');
}
?>