<?php

// Check connection
if (mysqli_connect_errno()) {
    $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.$_SERVER['HTTP_REFERER'];
    http_response_code(500);
    echo "Connection failed";
	
    file_put_contents( __DIR__ . '/../mysql_connection_err.txt', "Failed to connect to MySQL: " . mysqli_connect_error() . " time " . time() . PHP_EOL, FILE_APPEND | LOCK_EX);
    	
	$raw_req = file_get_contents('php://input');
	$param_req = json_encode($_REQUEST);
	file_put_contents( __DIR__ . '/../mysql_connection_err.txt', "DATA: " .$url . " raw_req " . $raw_req . " param_req " . $param_req . PHP_EOL, FILE_APPEND | LOCK_EX);

	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}