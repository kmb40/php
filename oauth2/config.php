<?php

require_once 'vendor/autoload.php';

# Show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Start session
session_start();

# Redirect user to the oauth2 providers authorization url to get an auth code
$clientID = '85208144447-jqod3gmv6iktttsf3spfuc97dnt4bcrh.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:3000/oauth2/welcome.php'; // Dev

#$redirectUri = 'https://www.quikstarts.xyz/redux24/6/php-oauth-login-out/welcome.php'; // Prod
#$tokenRevocationUrl = 'https://oauth2.googleapis.com/revoke';

# Create Google client
$client = new Google_Client();
$client->setClientId($clientID); // Set client id
$client->setClientSecret($clientSecret); // Set secret
$client->setRedirectUri($redirectUri); // Set redirect uri
$client->setPrompt('select_account'); // Set the prompt parameter to select_account
$client->addScope('email'); // Add email to scope
$client->addScope('profile'); // Add profile to scope

# Database connectivity
$hostname = "quikstarts.xyz:3306";
$username = "qsxyz_admin";
$password = "Marquis000@";
$database = "qsxyz_oauth2-php-login-logout";

$conn = mysqli_connect($hostname, $username, $password, $database);

?>