<?php

// include_once('config.php');

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('863007994435-1m19n8a6vsl997ltdlquk1abaghsukkl.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/client/Github/document_container/?action=home');
$client->addScope('email');
$client->addScope('profile');

$loginUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Google Login</title>
</head>
<body>
    <a href="<?php echo $loginUrl; ?>">Login with Google</a>
</body>
</html>
