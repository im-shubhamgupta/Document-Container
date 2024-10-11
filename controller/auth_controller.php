<?php
$response = array('check'=>'error' , 'msg'=>'Access Denied');
$submit_action = isset($_REQUEST['submit_action']) ? escapeStringTrim($_REQUEST['submit_action']) : '';
switch($submit_action){
	case 'log_in':
		//ini_set('display_errors',1);
		$response = array('check' => 'failed' , 'msg'=>'Something error Please try again' );
		// echoPrint($_REQUEST);
		// echoPrint($_SESSION);
		
		$login_by = isset($_REQUEST['login_by']) ? $_REQUEST['login_by'] : '';
		if($login_by  == 'google'){
			
			$gClient = new Google_Client();
			$gClient->setClientId(GOOGLE_CLIENT_ID);
			$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
			$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

			$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

			 // Check for errors
		    if (isset($token['error'])) {
		        echo "Error fetching token: " . $token['error'];
		        exit();
		    }

		    // Debugging: Print the token to ensure it's valid
		    // echoPrint($token['modelData:protected']);
		    // echo "<pre>";
		    // print_r($token);
		    // echo "</pre>";
		    $gClient->setAccessToken($token);

		    // Get user information
		    $oauth = new Google_Service_Oauth2($gClient);
		    $userinfo = $oauth->userinfo->get();

			// $gClient->setApplicationName('Login to Document Container');
			$temp['email'] = $userinfo['email'];
			$temp['givenName'] = $userinfo['givenName'];

			// [email] => shubhamgupta309@gmail.com
		    // [familyName] => Gupta
		    // [gender] => 
		    // [givenName] => Shubham
		    // [hd] => 
		    // [id] => 108690118069808322942
		    // [link] => 
		    // [locale] => 
		    // [name] => Shubham Gupta
		    // [picture] => https://lh3.googleusercontent.com/a/ACg8ocIGDExj4M6dAMkDSYi7Jamz3jvSvmAPG_SW3OiPHGo8FxXjKEA=s96-c
		    // [verifiedEmail] => 1
			$data = getSingleResult("SELECT * from backend_users where email = '".$temp['email']."' "); //also check name like

		}else{
			$temp = array(
				'password' => escapeStringTrim($_POST['password'])
			);
			if(is_numeric($_POST['username'])){
				$temp['mobile'] = escapeStringTrim($_POST['username']);
			}else{
				$temp['email'] = escapeStringTrim($_POST['username']);
				if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
					$response['msg'] = "Invalid email format";
					redirect('',$response);
				}
			}
			$password = escapeStringTrim($_POST['password']);
			$data = executeSelectSingle('backend_users',array(),$temp);
		}	

		
		if(count($data) > 0){
			$_SESSION['user_id'] = $data['id'];
			$_SESSION['email'] =  $data['email'];
			$_SESSION['login'] =  'y';
			// $response = '';
			$response['check'] = 'success';
            $response['msg'] = 'Login Successfully';
		}else{
			$response['msg'] = 'Please Enter correct Credentials';
		}
		// print_r()
		// request();
		// session();
		// debugSql();
		redirect('home',$response);
        die;
    break;
	case 'log_out':
		$response = array('check' => 'failed' , 'msg'=>'Not Logout' );
		if(isset($_SESSION)){
			$gClient = new Google_Client();
			session_unset();
			session_destroy();
			$gClient->revokeToken(); 
			$response['check'] = 'success';
            $response['msg'] = 'Logout Successfully';
		}
		redirect('',$response);
        die;
     break;
	default : 
		$response['check'] = 'error';
		$response['msg'] = 'Bad Request';
	break;	
}
// 
if(empty($_POST['submit_action'])){
	echo json_encode($response);
}
die;
?>