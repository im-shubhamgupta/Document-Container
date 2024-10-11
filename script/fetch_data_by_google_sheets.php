<?php
// https://developers.google.com/sheets/api/guides/create#php       //doc for help
// https://docs.google.com/spreadsheets/d/1FgcnYLwuVCEhfTL94kTbGsZdjz_X45RsXzBX0ydLPcU/edit?gid=0#gid=0
ini_set('display_errors',1);
include_once(__DIR__.'/../constant.php');
	//create executeInsertBind()
	// create executeInsert LIKE?
	$range = 'Project Details!A1:C5'; 
    $values = get_spreedsheet_data_from_id(SPREADSHEET_ID, $range);

    print_R($values);die("sto");

	if(count($values) > 0){
		$unset($values[0]);
		//prepare company details
		$project_name = array();
		// $links_arr = [];
		foreach($values as $val){
			$temp_arr = array();
			if(!empty(trim($val['3']))){
				$project_name = escapeStringTrim($val['3']);
				$temp_arr['author'] = escapeStringTrim($val['1']);
				$temp_arr['company_name'] = escapeStringTrim($val['2']);
				$temp_arr['project_name'] = escapeStringTrim($val['3']);
				$project_name[] =  escapeStringTrim($val['2']); 
				// array_push($links_arr, $temp_arr);
				$check = executeSelectSingle('project_master',array('project_id'),array(['LOWER(`project_name`)', '=', strtolower("$project_name")]));
				if(empty($check)){
					executeInsert('project_master',$temp_arr);
				}	
			}	
		}

		$check = executeSelectSingle('project_master',array('project_id'),
					array('DATE(created_at)'=> date('Y-m-d'),
						 ['LOWER(`project_master`)', 'IN','(' .implode(',',$project_name).')'])
					);

		// $sql = "SELECT * from `project_master` LIKE  where DATE(created_at) =  "; 
		// $data = getResultAsArray($sql);
		//make query for get all companies name

		// foreach($values as $val){
		// 	if(isset($data[$val['3']])){
		// 		$temp_arr = array();
		// 		$temp_arr['project_id'] = $data[$val['3']];
		// 		$temp_arr['project_links'] = escapeStringTrim($val['4']);
		// 		executeInsert('project_links',$temp_arr);
		// 	}
		// }














	}

	

	// if (empty($values)) {
	//     print "No data found.\n";
	// } else {
	//     foreach ($values as $row) {
	//         // Print columns A, B, and C, which correspond to indices 0, 1, and 2.
	//         echo $row[0] . ", " . $row[1] . ", " . $row[2] . "\n";
	//     }
	// }










?>