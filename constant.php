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
define("DIR",__DIR__.'/');//constant path
define("CONSTANT_FILE_PATH",__DIR__.'/');//constant path

define("FILE_NAME", basename(parse_url(ACTUAL_LINK)['path'],'.php') );//remove.php
define("COMMON_LIBRARY" , DOC_ROOT_PATH.'commonLibrary/');

define("DOCUENTS_UPLOAD_PATH",CONSTANT_FILE_PATH.'resources/documents/' );
define("VALID_IMG_EXT", array('png','jpg','jpeg','PNG','JPG','JPEG'));
define("DOCUMENT_PASSWORD", 8527);

/*for google login*/
define('GOOGLE_CLIENT_ID', '863007994435-63hpej51cmt69de48gs9g8pqt7ta26br.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', SITE_URL.'?controller=auth_controller&submit_action=log_in&login_by=google');

/*end */

define('CREDENTIAL_JSON', COMMON_LIBRARY.'phpv8/googleSpreadsheet.json');
define('GOOGLE_API_KEY', 'AIzaSyDX2zOjJCV4ceQaxkrv9TCJum_hg9VjJdE');
// define('GOOGLE_API_KEY', 'AIzaSyAHXBVeVhNh3X4M47mX9U-pcCxv20wTBFg'); //latest
// define('GOOGLE_API_KEY', 'f15d630586482c87578b03f250df67775ae0eaf4');


// define('GOOGLE_API_KEY', 'AIzaSyC1CZeBiAEKxH-sJQ7GQwJ4CQYh_4dTDXY');
// define('GOOGLE_API_KEY', 'AIzaSyCav4J1CBStGcsrOJM2Ua6LhdakiM9-yzI');//custom search api key
//AIzaSyDX2zOjJCV4ceQaxkrv9TCJum_hg9VjJdE

define('SPREADSHEET_ID', '1FgcnYLwuVCEhfTL94kTbGsZdjz_X45RsXzBX0ydLPcU');
define('GOOGLE_SPREADSHEET_LINK', 'https://docs.google.com/spreadsheets/d/1FgcnYLwuVCEhfTL94kTbGsZdjz_X45RsXzBX0ydLPcU/edit?gid=0#gid=0');
// define('MEETING_URL', SITE_URL."/library/video/meeting.php");
define('IMAGE_URL',DIR."/resources/css/img/");

const SHOW_USER_TYPE = array('add_data','all_data','add_document','all_document');

const CAT = array(
    'other' => 'Other',
    'self' => 'Self',
    'company' => 'Company'
);
const CATEGORY_ID = array(
        'personal' => 12
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
include_once(COMMON_LIBRARY."phpv8/encryption_by_key.php");
//add for google login
require_once CONSTANT_FILE_PATH.'google_sheets/new_composer/vendor/autoload.php';

// include_once(DIR."/db/mail.php");
// include_once(DIR."/db/DBcontroller.php");

//10-08-2024 for client ids
// client_id : 863007994435-63hpej51cmt69de48gs9g8pqt7ta26br.apps.googleusercontent.com
// client secret : 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
// Creation date October 10, 2024 at 4:51:32 PM GMT+5

