<?php
include('../constant.php');

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
		$sql="SELECT * from record_data "; 
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
			$sql="SELECT * from document "; 
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
	default:
		echo json_encode(array('check' => 'failed' , 'msg'=>'Bad Request' ));
	break;
}
