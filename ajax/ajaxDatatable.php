<?php
include('../constant.php');
if(isset($_SESSION['login']) && $_SESSION['login']=='y'){ //you can define user according to session
$response = array('check' => 'failed' , 'msg'=>'Something Error Please try again!!' );
$ajax_action = isset($_POST['ajax_action']) ? $_POST['ajax_action'] :'';
switch($ajax_action){
    case 'fetch_all_users':
		$data = array();
		$requestData= $_REQUEST;
		// $table ='';
		$columns = array( 
			0 =>'id',
			1 =>'user_type_name',
		);
		$sql="SELECT * from user_type where 1 "; 
		$totalData = getAffectedRowCount($sql);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		if($requestData['search']['value'] ) {  

			$sql.=" AND (  ";
			$sql.="  `type` LIKE '%".$requestData['search']['value']."%' ";
			$sql.=" OR `user_type_name` LIKE '%".$requestData['search']['value']."%' ";
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
		
		$arr = getResultAsArray($sql);
		// echoPrint($arr);
		foreach($arr as $k=>$list) {  // preparing an array
			$k++;
			$td = array();
			$td[] = $k;
			$td[] = $list['user_type_name'];
			// $td[] = $list['category_name'];
			$action ="<span><a href='javascript:void(0)' data-user_data='".json_encode(array('id'=>$list['id'],'user_type_name'=> $list['user_type_name']))."' onclick='mod_wise_category.set_data(this);' class='btn btn-success btn-sm btn-icon waves-effect waves-themed'><i class='fal fa-edit'></i></a></span>";
			$action .= '  <span><a href="#" onclick="delete_user(this)" data-id="'.$list['id'].'" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-times"></i></a></span>';
			
			$td[] = $action;
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