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
// print_r($_ENV);
// print_r(putenv());
// print_r(getenv());
// echo $dbHost = $_ENV['DB_HOST'];
// $dbUsername = $_ENV['DB_USERNAME'];
// $dbPassword = $_ENV['DB_PASSWORD'];
if(isset($_GET['debug'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

session_start();
define("DB_HOSTNAME", getenv('DB_HOST') );
define("DB_USERNAME", getenv('DB_USERNAME') );
define("DB_PASSWORD", getenv('DB_PASSWORD') );
define("DB_", getenv('DB_DATABASE') );

$mysqli = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error; 
  exit();
}

ob_start();

date_default_timezone_set('Asia/Kolkata');
    
$actual_link = ((empty($_SERVER['HTTPS'])) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


define("SITE_URL",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/client/Github/document_container/');

?>