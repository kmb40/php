<?php
// Establishes a connection to the database.

//Declare database variables
$serverName = "localhost:8889";
$dbUserName = "root";
$dbPassword = "root";
$dbName = "loginsystem";

// Assign db connection to a variable "conn".
// Note: mysqli is being used instead of mysql as it is more secure
$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName); 

// Display an error if the database connection fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>