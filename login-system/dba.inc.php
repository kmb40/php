<?php

//Declare database variables
$serverName = "localhost:8888";
$dbUserName = "root";
$dbPassword = "";
$dbName = "loginsystem";

// Assign db connection to a variable "conn".
// Note: mysqli is being used instead of mysql as it is more secure
$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName); 

// Display an error if the database connection fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>