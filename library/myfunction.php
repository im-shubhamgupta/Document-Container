<?php
use Google\Client;
use Google\Service\Sheets;
function url($path){
	return SITE_URL.$path;
}
function urlAction($path){
	return SITE_URL.'?action='.$path;
}
function urlController($path){
	return SITE_URL.'?controller='.$path;
}
function asset($path){
	return RESOURCE_URL.$path;
}
function redirect($route='',$response=''){  
	if(!empty($response)){
		$_SESSION['flash'] = $response;
	}
	$action = ($route) ? '?action='.$route : '';
	header('location:'.SITE_URL.$action); //you can add timing for delay
	//echo "<script>window.location()</script>";
	die;
}
// function sessionflush($msg){
// 	$_SESSION['msg'] = $msg;
// }
function sessionFlash(){
	if(isset($_SESSION['flash'])){
		echo $_SESSION['flash']['msg'];
		unset($_SESSION['flash']);
		//after return not possiblle to unset
	}
}
function sessionFlashClear($msg=''){
	// if(empty($msg)){
		unset($_SESSION['flash']);
		// ($_SESSION['msg'] == $msg && isset($_SESSION['msg'])) ? unset($_SESSION['msg'] : '';
	// }else{
	// 	// (isset($_SESSION['msg'])) ? unset($_SESSION['msg'] : '';
	// }
}	

function get_spreedsheet_data_from_id($spreadsheet_id, $range){
	require DIR.'google_sheets/new_composer/vendor/autoload.php';
	// require DIR.'library/vendor/autoload.php'; //error on autoload
 
	$client = new Client();
	$client->setAccessType('offline');
	$client->setAuthConfig(CREDENTIAL_JSON);
	$client->addScope(Sheets::SPREADSHEETS);
	// $client->addScope(Google\Service\Sheets::SPREADSHEETS);
	// $client->useApplicationDefaultCredentials();
	$client->addScope(Google_Service_Sheets::SPREADSHEETS);
	$client->setDeveloperKey(GOOGLE_API_KEY);
	$service = new Sheets($client);
	$response = $service->spreadsheets_values->get($spreadsheet_id, $range);

	// echo "google sheet data";
	
	return $response->getValues();
}
function uploadCustomFile($FILES, $params = array()){
	// echo "<pre>"; print_r($FILES);print_r($params);
	$result = array('check' => false, 'msg'=>"Something error");
	$result['file_upload'] = array('check'=> false, 'msg' => "Problem on Image uploading!!");
	$convert_file_base64 = 0;
	if(!empty($FILES)){
		// $params['file_path'] = DOCUENTS_UPLOAD_PATH;
        // $params['file_type'] = VALID_IMG_EXT;
		$imageFileType = strtolower(pathinfo(basename($FILES['name']),PATHINFO_EXTENSION));
		$valid_imgname = date('YmdHis')."_".rand('1000','9999').".".$imageFileType;

		$result['file_ext'] = !empty($imageFileType) ? $imageFileType : '';
		$result['file_name'] = !empty($valid_imgname) ? $valid_imgname : '';
		$result['file_size'] = !empty($FILES['size']) ? $FILES['size'] : '0';
		$fileName = (isset($params['file_name']) && $params['file_name']) ? trim($params['file_name']).'.'.$imageFileType : $valid_imgname;
		$fileType = (!$params['file_type']) ? array('png','jpg','jpeg'): $params['file_type'];
		$filePath = (!$params['file_path']) ? __DIR__ : $params['file_path'];

		if(!empty($fileType)){
			if(in_array($imageFileType, $fileType)){
				$result['check'] = true;
				$result['msg'] = $imageFileType." Extension Matched";
				$result['file_type'] = array(
					'check' => true,
					'msg' => $imageFileType." Extension Matched",
				);
			}else{
				$result['file_type'] = array(
					'check' => false,
					'msg' => "Accept only ".implode(', ',$fileType)." Extension Image only",
				);
				$result['msg'] = "Accept only ".implode(', ',$fileType)." Extension Image only";
			}	
		}
		if(isset($filePath) && !empty($filePath) && ($result['check']) && !empty($fileName)){
			if($convert_file_base64){
				// Get the uploaded image's binary data
			    $image_data = file_get_contents($FILES['tmp_name']);
			    $base64_image = base64_encode($image_data);
			    $mime_type = mime_content_type($FILES['tmp_name']);
			    // Create a data URI for the image
			    $result['base64_file_with_prefix'] = 'data:' . $mime_type . ';base64,' . $base64_image; 
			    $result['base64_file_without_prefix'] = 'base64,' . $base64_image;
			}
			

			if (move_uploaded_file($FILES["tmp_name"], $filePath.$fileName)){
				$result['check'] = true;
				$result['msg'] = "File Uploaded";
				$result['file_upload']['check'] = true;
				$result['file_upload']['msg'] = "File Uploaded";
			}else{
				$result['file_upload']['msg'] = "Problem on Image uploading";
				$result['msg'] = "Image not Uploaded";
			}	
		}
		// $result['file_tmp_name'] = !empty($FILES['tmp_name']) ? $FILES['tmp_name'] : '';
		if(!empty($result['file_type']) && !empty($result['file_name']) && !empty($result['file_size']) ){
			$result['check'] = true;
		}
	}else{
		$result['msg'] = "Document file can't empty";
	}
	return $result;
}
function convert_file_to_base64($file_path){
	$response = array('check'=> false);
	$response['base64_image_with_prefix']  = '';
	if(file_exists($file_path)){

		// Read the image file into binary data
		$image_data = file_get_contents($file_path);

		// Encode the binary data into base64
		$base64_image = base64_encode($image_data);

		// Get the MIME type of the image for embedding in an HTML tag
		$image_info = getimagesize($file_path);
		$mime_type = $image_info['mime'];

		// Combine the data URI with the base64 image string
		$base64_image_with_prefix = 'data:' . $mime_type . ';base64,' . $base64_image;
		$response['base64_image_with_prefix']  = 'data:' . $mime_type . ';base64,' . $base64_image;
	}else{
		$response['msg'] = 'file not exist';
	}
	return $response;
}
