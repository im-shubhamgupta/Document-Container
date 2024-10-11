<?php
if(isset($_GET['debugTest']) && $_GET['debugTest'] == 1){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if(stripos($_SERVER['PHP_SELF'],"ajaxHandller.php") !==  false){ //it's better when you use flag from js side
	include_once('../constant.php');//when we call ajaxHandller.php
	$enc = new encrypt_decrypt();
}

// $rawData = file_get_contents("php://input");
// // Decode the JSON data
// $data = json_decode($rawData, true);
// print_r($_REQUEST);
$response = array('check' => 'failed' , 'msg'=>'Access Denied' );
if(isset($_SESSION['login']) && $_SESSION['login']=='y'){ 

$response = array('check' => 'failed' , 'msg'=>'Something Error Please try again!!' );

$ajax_action = isset($_POST['ajax_action']) ? $_POST['ajax_action'] :'';
switch($ajax_action){
	case 'fetch_all_data':
		// echoPrint($_POST);
		$data = array();
		$requestData= $_REQUEST; 
		// $table ='';
		$columns = array( 
			0 =>'id',
			1 =>'category_id',
			2 =>'text',
			3 =>'source',
			4 =>'create_date',
		);
		$sql="SELECT * from record_data 
		LEFT JOIN category ON record_data.category_id = category.category_id
		where 1 "; 
		$totalData = getAffectedRowCount($sql);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		if($requestData['search']['value'] ) {  

			$sql.=" AND ( ";
			$sql.=" `text` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `source` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR category.`category_name` LIKE '%".$requestData['search']['value']."%' ";
			$sql.= " )";
		}
		$totalFiltered = getAffectedRowCount($sql); 

		//$sql .="ORDER BY id desc"; 

		$sql .=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$i=1;
		// echo $sql;
		$arr = executeQuery($sql);
		foreach($arr as $list) {  // preparing an array
			$td = array();
			// print_r($list);
			//$date=date('d-m-Y H:i:s ',strtotime($Row["notice_datetime"]));
			$td[] = $list['id'];
			$td[] = $list['category_name'];
			$td[] = $list['text'];
			$td[] = $list['source'];
			$td[] = '<span><a href="'.urlAction('add_data&id='.$list['id']).'" class="btn btn-success btn-sm btn-icon waves-effect waves-themed">
                            <i class="fal fa-edit"></i>
                                                    </a></span>';

			$data[] = $td;
			$i ++;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside ,
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
		);

		echo json_encode($json_data);  
		die;
	break; 
	case 'fetch_document_data':
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
			// echoPrint($_REQUEST);
			$requestData= $_REQUEST;
			// $table ='';
			$columns = array( 
				0 =>'id',
				1 =>'category',
				2 =>'name',
				3 =>'source',
				4 =>'create_date',
			);
			$sql="SELECT * from document where 1 "; 
			$totalData = getAffectedRowCount($sql);
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
	
			if($requestData['search']['value'] ) {  
	
				$sql.=" AND ( 1 ";
				$sql.=" OR `name` LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR `source` LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR `category` LIKE '%".$requestData['search']['value']."%' ";
				$sql.= " )";
			}
			$totalFiltered = getAffectedRowCount($sql); 
	
			//$sql .="ORDER BY id desc"; 
	
			$sql .=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$i=1;
			// $arr = executeQuery($sql);
			$arr = getResultAsArray($sql);
			foreach($arr as $list) { 
				$td = array();
				//$date=date('d-m-Y H:i:s ',strtotime($Row["notice_datetime"]));
				$img = explode(',',$list['image']);
				$images= '';
				// foreach($img as $key => $v){
				// 	$images.= "<span class='multi_img'><img src='".url('/resources/img/doc_img/'.$v)."' data-id='".$key."' title='".CAT[$list['category']]."' width='80' height='60' /></span>";
				// }
				foreach($img as $key => $v){
					$images.= "<span class='multi_img'><img src='".url('/resources/img/doc_img/'.$v)."' data-id='".$key."' title='' width='80' height='60' /></span>";
					//".CAT[$list['category']] ?? 'Title'."
					// $images .= '<a class="jg-entry entry-visible" href="'.url('/resources/img/doc_img/'.$v).'" style="width: 273px; height: 181.353px; top: 2136.32px; left: 741px;">';
					// $images .= '<img class="img-responsive" src="'.url('/resources/img/doc_img/'.$v).'" alt="image" style="width: 80px; height: 60px;">';
					// $images .= '<div class="caption">image</div></a>';
				}
				 
				$td[] = $list['id'];
				$td[] = '';//CAT[$list['category']] ?? 'N/A';
				$td[] = $list['name'];
				$td[] = $images;
				$td[] = '<span><a href="'.urlAction('add_document&id='.$list['id']).'" class="btn btn-success btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-edit"></i></a></span>';
	
				$data[] = $td;
				$i ++;
			}
	
			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside ,
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);
	
			echo json_encode($json_data);
		die;	
	break;	
	case 'get_all_category_data':
		$data = array();
		$requestData= $_REQUEST;
		// $table ='';
		$columns = array( 
			0 =>'category_id',
			1 =>'type',
			2 =>'category_name',
			// 3 =>'create_date',
			// 4 =>'create_date',
		);
		$sql="SELECT * from category where 1 "; 
		$totalData = getAffectedRowCount($sql);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		if($requestData['search']['value'] ) {  

			$sql.=" AND (  ";
			$sql.="  `type` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `category_name` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `create_date` LIKE '%".$requestData['search']['value']."%' ";
			$sql.= " )";
		}
		$totalFiltered = getAffectedRowCount($sql);  

		if(isset($requestData['order'][0]['column'])){
			$sql .=" ORDER BY ". $columns[$requestData['order'][0]['column']]."  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		}else{
			$sql .=" ORDER BY category_id DESC  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
		}
		$i=1;
		// $arr = executeQuery($sql);
		$arr = getResultAsArray($sql);
		// echoPrint($arr);
		foreach($arr as $k=>$list) {  // preparing an array
			$k++;
			$td = array();
			$td[] = $k;
			$td[] = $list['type'];
			$td[] = $list['category_name'];
			$btnAction ="<span><a href='javascript:void(0)' data-cat_data='".json_encode(array('id'=>$list['category_id'],'category_name'=> $list['category_name']))."' onclick='mod_wise_category.set_data(this);' class='btn btn-success btn-sm btn-icon waves-effect waves-themed'><i class='fal fa-edit'></i></a></span>";
			// $action .="&nbsp;&nbsp; <span><a href='javascript:void(0)' data-id='".$list['id']."' onclick='deleteCategory(this);' class='btn btn-danger btn-sm btn-icon waves-effect waves-themed'><i class='fal fa-delete'></i>";
			$btnAction .= '  <span><a href="#" onclick="delete_category(this)" data-id="'.$list['category_id'].'" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-times"></i></a></span>';
			
			$td[] = $btnAction;
			$data[] = $td;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data  
		);
		
		echo json_encode($json_data);
	break;
	case 'submit_form_data':
		// print_R($_POST);
		$response = array('check' => 'failed' , 'msg'=>'Something error, Please try again' );
		$id = !empty($_POST['id']) ? escapeStringTrim($_POST['id']) : '';
		$files = isset($_POST['fileToUpload']) ? ($_POST['fileToUpload']) : [];
		$batch = getSingleResult("SELECT IF(MAX(`batch`) = '' || MAX(`batch`)  IS NULL , '1', MAX(`batch`) + 1) as last_batch from uploaded_files");

		$data = array(
			'text' => escapeStringTrim($_POST['text']),
			'source' => escapeStringTrim($_POST['source']),
			'category_id' => escapeStringTrim($_POST['category_id']),
			'user_type' => (isset($_SESSION['user_type']) && !empty($_SESSION['user_type'])) ? escapeStringTrim($_SESSION['user_type']) : '1',
			'is_encrypt' => (isset($_POST['is_encrypt']) && !empty($_POST['is_encrypt'])) ? $_POST['is_encrypt']  : '0',
		);

		if($data['is_encrypt'] == 1){
			$data['source'] = $enc->encrypt($data['source']);
		}

		if($id > 0){//update
			$id = escapeStringTrim($_POST['id']);
			$text = escapeStringTrim($_POST['text']);
			$data['modify_date'] = date("Y-m-d H:i:s");

			$sql= "SELECT * from record_data where `text` = '".$text."' and id!= '$id' ";
			$res = getSingleResult($sql);
			if(count($res) > 0 ){
				$response['msg'] = "Text is already exist";
				$_SESSION['temp_POST'] = $_POST; 
				redirect('form',$response);
			}else{
				$update = executeUpdate('record_data',$data,array('id'=>$id));
				if($update){
					foreach($files as $val ){
						$file_arr = array(
							'data_id' => $id,
							'file_name' => $val,
							'file_base64' => convert_file_to_base64(DOCUENTS_UPLOAD_PATH.$val)['base64_image_with_prefix'],
							'batch' => $batch['last_batch'],
							'uploaded_by' => $_SESSION['user_id'],
							'added_on' => date("Y-m-d H:i:s"),
						);
						executeInsert('uploaded_files',$file_arr);
					}
					$response['check'] = 'success';
					$response['msg'] = "Data updated Sucessfully";
				}
			}	
		}else{//add

			$text = escapeStringTrim($_POST['text']);
			$sql= "SELECT * from record_data where `text` = '".$text."'";
			$res = getSingleResult($sql);
			if(count($res) > 0 ){
				$response['msg'] =  "Text is already exist";
				// $_SESSION['temp_POST'] = $_POST; 
				// redirect('form',$response);
			}
			else{
				$data['create_date'] = date("Y-m-d H:i:s");
				$insert = executeInsert('record_data',$data);
				if($insert){
					foreach($files as $val ){
						$file_arr = array(
							'data_id' => $insert,
							'file_name' => $val,
							'file_base64' => convert_file_to_base64(DOCUENTS_UPLOAD_PATH.$val)['base64_image_with_prefix'],
							'batch' => $batch['last_batch'],
							'uploaded_by' => $_SESSION['user_id'],
						);
						executeInsert('uploaded_files',$file_arr);
					}
					$response['check'] = 'success';
					$response['msg'] = "Data Inserted Sucessfully";
				}
			}	
		}
		exit(json_encode($response));
		break; 
	case 'add_category_data':
		$response = array('check' => 'failed' , 'msg'=>'Something error, Please try again' );
		$id = !empty($_POST['id']) ? escapeStringTrim($_POST['id']) : '';
		$temp = array(
			'type' => isset($_POST['type']) ? escapeStringTrim($_POST['type']) : '',
			'category_name' => escapeStringTrim($_POST['category_name']),
			'create_date' => date("Y-m-d H:i:s")
		);

		if($id > 0){
			$check_data = getSingleResult("SELECT `id` from  category where `category_name`= '".$temp['category_name']."' and id != '".$id."' ");
			
			if(empty($check_data)){
				$update = executeUpdate('category',$temp,array('id'=>$id));
				if(!empty($update) > 0){	
					$response['check'] = 'success';
					$response['msg'] = 'Data Updated Successfully';
				}
			}else{
				$response['msg'] = 'Category Already Exist';
			}
		}else{
			$check_data = getSingleResult("SELECT `category_id` from  category where `category_name`= '".$temp['category_name']."' ");
			// print_R($check_data);
			if(empty($check_data)){
				$insert = executeInsert('category',$temp);
				if(!empty($insert) > 0){	
					$response['check'] = 'success';
					$response['msg'] = 'Data Inserted Successfully';
				}
			}else{
				$response['msg'] = 'Category Already Exist';
			}
		}
		echo json_encode($response);
		die;
	break; 
	case 'delete_category':
			$id = escapeString($_POST['id']);
			if (!empty($id)) {
				// print_R($_POST);
				$del = executeDelete('category', array('id' => $id));
				if ($del) {
					$response['check'] = 'success';
					$response['msg'] = 'Delete Successfully';
				} else {
					$response['msg'] = 'Error Happend';
				}
			} else {
				$response['msg'] = 'Delete id not found';
			}
			echo json_encode($response);
		die;
		break;
	case 'delete_user':
			$id = escapeString($_POST['id']);
			if (!empty($id)) {
				$del = executeDelete('user_type', array('id' => $id));
				if ($del) {
					$response['check'] = 'success';
					$response['msg'] = 'Delete Successfully';
				} else {
					$response['msg'] = 'Error Happend';
				}
			} else {
				$response['msg'] = 'Delete id not found';
			}
			echo json_encode($response);
		die;
		break;	
	case 'add_user_type':
			$response = array('check' => 'failed' , 'msg'=>'Something error, Please try again' );
			$id = !empty($_POST['id']) ? escapeStringTrim($_POST['id']) : '';
			$temp = array(
				'user_type_name' => escapeStringTrim($_POST['user_type_name']),
				'modify_date' => date("Y-m-d H:i:s")
			);
	
			if($id > 0){
				$check_data = getSingleResult("SELECT `id` from  user_type where `user_type_name`= '".$temp['user_type_name']."' and id != '".$id."' ");
				
				if(empty($check_data)){
					$update = executeUpdate('user_type',$temp,array('id'=>$id));
					if(!empty($update) > 0){	
						$response['check'] = 'success';
						$response['msg'] = 'Data Updated Successfully';
					}
				}else{
					$response['msg'] = 'User Already Exist';
				}
			}else{
				$check_data = getSingleResult("SELECT `id` from  user_type where `user_type_name`= '".$temp['user_type_name']."' ");
				// print_R($check_data);
				if(empty($check_data)){
					$temp['create_date'] = date("Y-m-d H:i:s");
					// print_R($temp);
					$insert = executeInsert('user_type',$temp);
					if(!empty($insert) > 0){	
						$response['check'] = 'success';
						$response['msg'] = 'Data Inserted Successfully';
					}
				}else{
					$response['msg'] = 'User Already Exist';
				}
			}
			echo json_encode($response);
			die;
		break;
		case 'change_user_type':
			$user_type = escapeString($_POST['user_type']);
			if (!empty($user_type)) {
				$_SESSION['user_type'] = $user_type;
				if (isset($_SESSION['user_type'])) {
					$response['check'] = 'success';
					$response['msg'] = 'user changed Successfully';
				} else {
					$response['msg'] = 'Error Happend';
				}
			} else {
				$response['msg'] = 'data not found';
			}
			echo json_encode($response);
		die;
		break;
	case 'upload_document_file':
		
		$params['file_path'] = DOCUENTS_UPLOAD_PATH;
        $params['file_type'] = VALID_IMG_EXT;
		$result = uploadCustomFile($_FILES['file'],$params);
		if($result['check']){
			// $temp = array(
			// 	'image_name' => 
			// );
			// executeInsert('record_data',array()); 

			$response['check'] = 'success';
			$response['data'] = $result;
		}
		exit(json_encode($result));
		break;
	case 'get_source_data':
			$id = escapeString($_POST['id']);
			$response['msg'] = 'Something error';
			if ($id) {
				$data = executeSelectSingle('record_data',array(), array('id' => $id));
				$enc = new encrypt_decrypt();
				if ($data) {
					$response = [];
					$response['check'] = 'success';
					$data['source'] = ($data['is_encrypt'] == 1) ? stripcslashes($enc->decrypt($data['source'])) : stripcslashes($data['source']) ;
					$response['data'] = $data;
				} else {
					$response['msg'] = 'Error Happend';
				}
			}
			echo json_encode($response);
		die;
		break;
	case 'submit_add_document':
		// print_R($_POST);
		$response = array('check' => 'failed' , 'msg'=>'Something error, Please try again' );
		$id = !empty($_POST['id']) ? escapeStringTrim($_POST['id']) : '';
		$files = isset($_POST['fileToUpload']) ? ($_POST['fileToUpload']) : [];
		$batch = getSingleResult("SELECT IF(MAX(`batch`) = '' || MAX(`batch`)  IS NULL , '1', MAX(`batch`) + 1) as last_batch from uploaded_files");

		$data = array(
			'name' => escapeStringTrim($_POST['title']),
			// 'source' => escapeStringTrim($_POST['source']),
			'category_id' => escapeStringTrim($_POST['category_id']),
			'user_type' => (isset($_SESSION['user_type']) && !empty($_SESSION['user_type'])) ? escapeStringTrim($_SESSION['user_type']) : '1',
			'is_encrypt' => (isset($_POST['is_encrypt']) && !empty($_POST['is_encrypt'])) ? $_POST['is_encrypt']  : '0',
		);

		// if($data['is_encrypt'] == 1){
		// 	$data['source'] = $enc->encrypt($data['source']);
		// }
			// $text = escapeStringTrim($_POST['text']);
			// $sql= "SELECT * from document where `text` = '".$text."'";
			// $res = getSingleResult($sql);
			// if(count($res) > 0 ){
			// 	$response['msg'] =  "Text is already exist";
			// 	// $_SESSION['temp_POST'] = $_POST; 
			// 	// redirect('form',$response);
			// }
			// else{
				$data['create_date'] = date("Y-m-d H:i:s");
				$data['modify_date'] = date("Y-m-d H:i:s");
				$insert = executeInsert('document',$data);
				if($insert){
					foreach($files as $val ){
						$file_arr = array(
							'document_id' => $insert,
							'file_name' => $val,
							'file_base64' => convert_file_to_base64(DOCUENTS_UPLOAD_PATH.$val)['base64_image_with_prefix'],
							'batch' => $batch['last_batch'],
							'uploaded_by' => $_SESSION['user_id'],
							'added_on' => date("Y-m-d H:i:s")
						);
						executeInsert('uploaded_files',$file_arr);
					}
					$response['check'] = 'success';
					$response['msg'] = "Document Uploaded Sucessfully";
				}
			// }	
				// echo 1;
		exit(json_encode($response));
		break;		 	
	default:
		echo json_encode(array('check' => 'failed' , 'msg'=>'Bad Request' ));
	break;
}

}else{
	echo json_encode($response);
}
//give die for safety reason
//suppose if $action is rewrite then ajax entered the footer and show all html so that your ajax data will not worked
//so must give die or exit 
die;
