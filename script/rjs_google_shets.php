<?php
$spreadsheetId = get_spreedsheetid_from_link(QUIZ_GOOGLE_SHEET_LINK);

    $workshop_name = !empty($wf_data['name']) ? $wf_data['name'] : $wf_data['full_name'];
    $sheetname = trim(QUIZ_SHEETNAME_PREFIX . $workshop_name);
    $checkSheet = checkSheetExistsOrNot($spreadsheetId, $sheetname);

    $range = $sheetname . '!A:K';
    $data = getGoogleSpreadsheetData($spreadsheetId, $range);
    unset($data[0]); //remove header

    ------------------------------------------------------------------
    function get_spreedsheetid_from_link($link){
    if(stripos($link, "https://docs.google.com/spreadsheets/") !== false){
        $tmp_link = str_replace("https://docs.google.com/spreadsheets/d/", "", $link);
        $tmp_arr = explode("/edit", $tmp_link);
        return $tmp_arr[0];
    }else{
        return "";
    }
}--------------------------------
function checkSheetExistsOrNot($spreadsheetId = '', $sheetName = ''){
    if(trim($spreadsheetId) != ''){
        $client = getClient();
        $service = new Google_Service_Sheets($client);
   
        $sheetInfo = $service->spreadsheets->get($spreadsheetId);
        $allsheet_info = $sheetInfo['sheets'];
        //$idCats = array_column($allsheet_info, 'properties');

        foreach ($allsheet_info as $val) {
            if ($val['properties']['title'] == $sheetName) {
                return true;
            }
        }
    }
    return false;
}
-----------------------------------------

function getGoogleSpreadsheetData($spreadsheetId, $range = "") {
    $client = getClient();
    $service = new Google_Service_Sheets($client);
    
    // Prints the names and majors of students in a sample spreadsheet:
    // https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
    //$spreadsheetId = '1HQSG0rthIxaetNwAdMPSEAD5B-G8SCYLeia2TVyVhj0';
    //$range = "'Sheet 1'!A:C";
    if(empty($range)){
        $sheet_data = $service->spreadsheets->get($spreadsheetId);
        $range = "'".$sheet_data['sheets'][0]['properties']['title']."'!A:M";
    }
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    return $response->getValues();
}
--------------------------------------------
$quiz_arr = array();
    $gsheet_write_arr = array();
    $spreadsheetId = get_spreedsheetid_from_link(QUIZ_GOOGLE_SHEET_LINK);

    $workshop_name = !empty($wf_data['name']) ? $wf_data['name'] : $wf_data['full_name'];
    $sheetname = trim(QUIZ_SHEETNAME_PREFIX . $workshop_name);
    $checkSheet = checkSheetExistsOrNot($spreadsheetId, $sheetname);

    if (!$checkSheet) {
        createNewSheetTabInGoogleSheet($spreadsheetId, $sheetname);
    } else {
        clearSheet($spreadsheetId, $sheetname);
    }
    $headers = array();
    $headers[] = array('DAYCOUNT', 'START TIME', 'TYPE', 'TITLE', 'ACTION TITLE' ,'DESCRIPTION', 'STATUS', 'QUESTION NO', 'QUESTION', 'OPTIONS', 'CORRECT ANSWER');
    batchUpdateValuesIntoGoogleSpreadsheet($spreadsheetId, $sheetname . '!A1', 'RAW', $headers);
    googleSheetHeaderFormat($spreadsheetId, $sheetname);

    $update_range = $sheetname . '!A2';
    
    $res = batchUpdateValuesIntoGoogleSpreadsheet($spreadsheetId, $update_range, 'RAW', $gsheet_write_arr);







    ----------------------------------------------
    function createNewSheetTabInGoogleSheet($spreadsheetId, $newSheetTitie){
    if(trim($spreadsheetId) != ''){
        $client = getClient();
        $service = new Google_Service_Sheets($client);
        
        $body = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array('requests' => array('addSheet' => array('properties' => array('title' => $newSheetTitie, 'index' => 0)))));
     
        $result = $service->spreadsheets->batchUpdate($spreadsheetId,$body);
        
    }
    return false;
}
---------------------------------
function clearSheet($spreadsheetID, $sheetName){
    $client = getClient();
    $service = new Google_Service_Sheets($client);

    $sheetInfo = $service->spreadsheets->get($spreadsheetID);
    $allsheet_info = $sheetInfo['sheets'];

    foreach ($allsheet_info as $key => $val) {
        if ($val['properties']['title'] == $sheetName) {
            $sheetId = $sheetInfo->sheets[$key]->properties->sheetId;
        }
    }

    $request = new Google_Service_Sheets_UpdateCellsRequest([
        'updateCells' => [ 
            'range' => [
                'sheetId' => $sheetId 
            ],
            'fields' => "*" 
        ]
      ]);
    $requests[] = $request;
    
    $requestBody = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest();
    $requestBody->setRequests($requests);

    try {
        $response = $service->spreadsheets->batchUpdate($spreadsheetID, $requestBody);
        return $response;
    } catch (Exception $e) {
        echo 'Error clearing sheet: ' . $e->getMessage();
        return false; // Return false to indicate failure
    }
    // $response = $service->spreadsheets->batchUpdate($spreadsheetID, $requestBody);
    // return $response;
}

----------------------------