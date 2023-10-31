<?php 

#$host = "localhost"; // For testing with a local database 
$host = "quikstarts.com:3306"; // For testing with a remote database
$username = "quikstar_admin";
$password = "marquis";
$dbname = "quikstar_freedom";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {

    die("Connection Failed: " . mysqli_connect_error());
} else {

    // echo 'Connection Succeeded!'; // Uncomment for testing db connection
}

?>