<?php

 $envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);  // file()
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}
// $dbHost = getenv('DB_HOST');
// $dbUsername = getenv('DB_USERNAME');
// $dbPassword = getenv('DB_PASSWORD');

// ----

// echo "<pre>";
// print_R($_SERVER);
// if(isset($_SERVER['HTTP_REFERER'])) {
//     $previousUrl = $_SERVER['HTTP_REFERER'];
//     echo "Previous URL: " . $previousUrl;
// } else {
//     echo "Previous URL is not available.";
// }
// echo phpinfo();
// print_r($_ENV);
// print_r(putenv());
// print_r(getenv());
// echo $dbHost = $_ENV['DB_HOST'] ;
// $dbUsername = $_ENV['DB_USERNAME'];
// $dbPassword = $_ENV['DB_PASSWORD'];
if(isset($_GET['debugTest']) && $_GET['debugTest'] == 1){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if(isset($_GET['checkPrint']) && $_GET['checkPrint'] == 1){
	echo "<pre>";
	var_dump($_REQUEST);
    echo "<br>session<br>";
	print_r($_SESSION);
	echo "</pre>";
} 

session_start();
define("DB_HOSTNAME", getenv('DB_HOST') );
define("DB_USERNAME", getenv('DB_USERNAME') );
define("DB_PASSWORD", getenv('DB_PASSWORD') );
define("DB_", getenv('DB_DATABASE') );

if(!empty(DB_HOSTNAME) ||  !empty(DB_USERNAME) || !empty(DB_PASSWORD) || !empty(DB_)){

    $mysqli = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_);
    // Check connection
    if ($mysqli -> connect_errno) {
        include_once(__DIR__.'/include/mysql_connection_err.php');
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error; 
    exit();
    }
}else{
    die("sorry, Credential not Found"); 
}

ob_start(); //it's remoove the error of header() in php : error header already redirect

date_default_timezone_set('Asia/Kolkata');
    
$actual_link = ((empty($_SERVER['HTTPS'])) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


define("SITE_URL",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/client/Github/document_container/');

?>