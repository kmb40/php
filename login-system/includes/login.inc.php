<?php

if (isset($_POST["submit"])) {// Validate if the login form was used to reach this page, if not redirect to login.php page

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
   
    // Database connectivity handling
    require_once 'dba.inc.php';    

    // Error hanlding and other functions
    require_once 'functions.inc.php'; 

    // If any input fields are empty redirect user to login page with an error attached to the url
    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit(); // Stops the script from running
    }

    loginUser($conn, $username, $pwd);
}
    else {
        header("location: ../login.php");
        exit(); // Stops the script from running
}
