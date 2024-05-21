<?php
include_once("config.php");
// Custom error handler function
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    if ($errno === E_ERROR || $errno === E_PARSE || $errno === E_CORE_ERROR || $errno === E_COMPILE_ERROR) {
        // Fatal error detected
        echo "A fatal error occurred: $errstr in $errfile on line $errline";
        // You can perform additional actions here, such as logging the error
    }
    // Return false to execute the default PHP error handler
    return false;
}

// Set custom error handler
set_error_handler('customErrorHandler');

// Your PHP code here

// echo SITE_URL;
// echo $url = $URLPREFIX . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'];

// $parse_url_data_arr = explode("/", trim(substr(SITE_URL, strlen(SITE_URL)), "/"));
// echo "<pre>";
// print_R($parse_url_data_arr);
// $action = $parse_url_data_arr[0];
$ajax_request = '';
if(isset($_GET['get_ajax']) && empty($_GET['get_ajax'])){
    die('ajax_data_not_found');
}elseif(isset($_GET['get_ajax']) && !empty($_GET['get_ajax'])){
    $action = 'get_ajax';
    $ajax_request = isset($_GET['get_ajax']) ? $_GET['get_ajax'] : '' ;
}else{
    $action = isset($_GET['action']) ? $_GET['action'] : '' ;
}


define("ACTION", $action);
define("AJAX_REQUEST", $ajax_request);
define("RESOURCE_URL",SITE_URL.'/resources/');
define("DIR",__DIR__);//constant path

define("FILE_NAME", basename(parse_url($actual_link)['path'],'.php') );//remove.php




// define('MEETING_URL', SITE_URL."/library/video/meeting.php");
define('IMAGE_URL',DIR."/resources/css/img/");

const CAT = array(
    'other' => 'Other',
    'self' => 'Self',
    'company' => 'Company'
);


// class payment{
//     const merchantId = 'PGTESTPAYUAT';
//     const apiKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
//     const RAZORPAY_KEY = 'rzp_test_NqotmWC1EGbE3A';
// }
// class mailer{
//     const host = 'smtp.gmail.com';
//     const port = '587';
//     const username = 'shubhamgupta309@gmail.com';
//     const sendername = 'ShubhamGupta';
//     const password = 'zwyhduclrclgrajd';
// }
class mailer{
    const host = 'smtp.gmail.com';
    const port = '587';
    const username = 'erptin@gmail.com';
    const sendername = 'ShubhamGupta';
    const password = 'muqrkcjpphroacuk';
}



//
// $action = basename($url, '.php'); //remove .php
// $url = 'http://learner.com/learningphp.php?lid=1348';
// $file_name = basename(parse_url($url, PHP_URL_PATH));


include_once(DIR."/db/db.php");
include_once(DIR."/library/myfunction.php");
// include_once(DIR."/db/mail.php");
// include_once(DIR."/db/DBcontroller.php");


