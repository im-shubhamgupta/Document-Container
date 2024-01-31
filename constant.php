<?php
if(isset($_GET['debug'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

session_start();
define("DB_HOSTNAME", "localhost" );
define("DB_USERNAME", "root" );
define("DB_PASSWORD", "" );
define("DB_", "self_evokewise" );

$mysqli = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error; 
  exit();
}

ob_start();

date_default_timezone_set('Asia/Kolkata');
    
$actual_link = ((empty($_SERVER['HTTPS'])) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$action = isset($_GET['action']) ? $_GET['action'] : '' ;


define("SITE_URL",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/client/Github/document_container/');

define("RESOURCE_URL",SITE_URL.'/resources/');
define("DIR",__DIR__);//constant path

define("FILE_NAME", basename(parse_url($actual_link)['path'],'.php') );//remove.php


const PAYMENT_STATUS = array(
    0 => 'pending', 
    1 => 'process' , 
    2 => 'complete'
);

define('MEETING_URL', SITE_URL."/library/video/meeting.php");
define('IMAGE_URL',DIR."/resources/css/img/");

const CAT = array(
    'other' => 'Other',
    'self' => 'Self',
    'company' => 'Company'
);


class payment{
    const merchantId = 'PGTESTPAYUAT';
    const apiKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
    const RAZORPAY_KEY = 'rzp_test_NqotmWC1EGbE3A';
}
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


