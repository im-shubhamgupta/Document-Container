<?php
// include('../constant.php');
// print_R($_REQUEST);
// session();
$response = array('check' => 'failed' , 'msg'=>'Access Denied' );
if(isset($_SESSION['login']) && $_SESSION['login']=='y'){ 

$response = array('check' => 'failed' , 'msg'=>'Something Error Please try again!!' );


$ajax_action = isset($_POST['ajax_action']) ? $_POST['ajax_action'] :'';
switch($ajax_action){
	case 'fetch_all_data':
		// echoPrint($_POST);
		$requestData= $_REQUEST;
		// $table ='';
		$columns = array( 
			0 =>'id',
			1 =>'category',
			2 =>'text',
			3 =>'source',
			4 =>'create_date',
		);
		$sql="SELECT * from record_data where 1 "; 
		$totalData = getAffectedRowCount($sql);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		if($requestData['search']['value'] ) {  

			$sql.=" AND ( 1 ";
			$sql.=" OR `text` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `source` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `category` LIKE '%".$requestData['search']['value']."%' ";
			$sql.= " )";
		}
		$totalFiltered = getAffectedRowCount($sql); 

		//$sql .="ORDER BY id desc"; 

		$sql .=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$i=1;
		$arr = executeQuery($sql);
		foreach($arr as $list) {  // preparing an array
			$td = array();
			// print_r($list);
			//$date=date('d-m-Y H:i:s ',strtotime($Row["notice_datetime"]));
			$td[] = $list['id'];
			$td[] = CAT[$list['category']] ?? 'N/A';
			$td[] = $list['text'];
			$td[] = $list['source'];
			$td[] = '<span><a href="'.urlAction('form&id='.$list['id']).'" class="btn btn-success btn-sm btn-icon waves-effect waves-themed">
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
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
			// echoPrint($_POST);
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
					$images.= "<span class='multi_img'><img src='".url('/resources/img/doc_img/'.$v)."' data-id='".$key."' title='".CAT[$list['category']]."' width='80' height='60' /></span>";
					// $images .= '<a class="jg-entry entry-visible" href="'.url('/resources/img/doc_img/'.$v).'" style="width: 273px; height: 181.353px; top: 2136.32px; left: 741px;">';
					// $images .= '<img class="img-responsive" src="'.url('/resources/img/doc_img/'.$v).'" alt="image" style="width: 80px; height: 60px;">';
					// $images .= '<div class="caption">image</div></a>';
				}
				 
				$td[] = $list['id'];
				$td[] = CAT[$list['category']] ?? 'N/A';
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
			0 =>'id',
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
			$sql .=" ORDER BY id DESC  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
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
			$btnAction ="<span><a href='javascript:void(0)' data-cat_data='".json_encode(array('id'=>$list['id'],'category_name'=> $list['category_name']))."' onclick='mod_wise_category.set_data(this);' class='btn btn-success btn-sm btn-icon waves-effect waves-themed'><i class='fal fa-edit'></i></a></span>";
			// $action .="&nbsp;&nbsp; <span><a href='javascript:void(0)' data-id='".$list['id']."' onclick='deleteCategory(this);' class='btn btn-danger btn-sm btn-icon waves-effect waves-themed'><i class='fal fa-delete'></i>";
			$btnAction .= '  <span><a href="#" onclick="delete_category(this)" data-id="'.$list['id'].'" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-times"></i></a></span>';
			
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
			$check_data = getSingleResult("SELECT `id` from  category where `category_name`= '".$temp['category_name']."' ");
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
