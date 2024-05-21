<?php

$authenticated_auth = false;

$path_auth = isset($parse_url_data_arr[1]) ? $parse_url_data_arr[1] : '';

$sbmtajax_auth = isset($_POST['sbmt_ajax']) ? $_POST['sbmt_ajax'] : '';

$authenticated_action = array(
    "Admin Access" => array(
        "action" => array(
            "administrators",
            "add_admin",
            "mod_admin"
        ),
        "ajax" => array("administrator")
    ),
    "Reports" => array(
        "action" => array(   
            "reports",
            "estate_purchase_register",
        ),
        "ajax" => array(
            "estate_purchase_register",
            //"freight_bill",
            "stock_reconciliation",
            "garden_status_report",
           
        )
    ),
    "Master" => array(
        "action" => array(
            "category",
            "users"
        ),
        "ajax" => array(
            "ajaxHandller",
        )
    ),
    // "Delete" => array(
    //     "remove_admin_record"
    // )
);
//disadvantage 
//suppose category is already define at other action then it's pass
// security solutions  ?action=master/action|category    after | this file name
// prevention
// donot use same file name for safety
// echoPrint($authenticated_action);
// echo "-------------------------------";
if(ACTION!='login' && ACTION!='logout') {
    $authenticated_auth = false; 
     foreach ($authenticated_action as $index_auth => $permission_auth) {

        // echoPrint($permission_auth["action"]);
        // echoPrint($index_auth);
        //for harcoded verify
        if ((in_array(ACTION, $permission_auth["action"]))){
           $authenticated_auth = true;
        }
        elseif(in_array(AJAX_REQUEST, $permission_auth["ajax"])){
            $authenticated_auth = true;
        }
        // if (array_key_exists(ACTION, $permission_auth['action'])){
        //     $authenticated_auth = true;
        // }

        // elseif((ACTION == 'get_ajax') && (array_key_exists($permission_auth, $authenticated_action)) && (in_array($path_auth, $authenticated_action[$permission_auth]["get_ajax"]))) {
        //     $authenticated_auth = true;
        // }
        // elseif((ACTION == 'get_ajax') && ($permission_auth == 'Delete') && (in_array($sbmtajax_auth, $authenticated_action["Delete"]))) {
        //     $authenticated_auth = true;
        // }
        
        // if($authenticated_auth)
        //     break;
        
    }
if($authenticated_auth){
    // die("Passed"); 
}else{
    die("Failed"); 
}
    
    /*foreach ($_SESSION['info']['permission'] as $index_auth => $permission_auth) {
    
        if ((array_key_exists($permission_auth, $authenticated_action)) && (in_array(ACTION, $authenticated_action[$permission_auth]["action"]))) {
           $authenticated_auth = true;
        }
        elseif((ACTION == 'ajax') && (array_key_exists($permission_auth, $authenticated_action)) && (in_array($path_auth, $authenticated_action[$permission_auth]["ajax"]))) {
            $authenticated_auth = true;
        }
        elseif((ACTION == 'ajax') && ($permission_auth == 'Delete') && (in_array($sbmtajax_auth, $authenticated_action["Delete"]))) {
            $authenticated_auth = true;
        }
        
        if($authenticated_auth)
            break;
    }*/
    
    if(!$authenticated_auth){
        // ACTION = "404";
        die('404 detected');
        unset($_POST);
        unset($_FILES);
        unset($_GET);
    }



}