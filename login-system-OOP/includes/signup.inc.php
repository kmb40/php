<?php

if (isset($_POST["submit"])) {// Validate if the login form was used to reach this page, if not redirect to signup.php page

    // Capturing data from signup form on the index page
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];

    // Instantiate SignContr class at signup-contr-classes.php 
    include "../classes/dbh.classes.php"; // Include this file
    include "../classes/signup.classes.php"; //Include this file
    include "../classes/signup-contr.classes.php"; //Include this file
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email); //Assign a new instance of the object to variable $signup

    // Running error handles and user signup
    $signup->signupUser();

    //require_once 'dba.inc.php';    // Commented out because dbh.classes.php handles the work.

    // Error handling and other functions //Commented out because signup-contr-classes.php handles the work.
    /*
    require_once 'functions.inc.php'; 

    // If any input fields are empty redirect user to signup page with an error attached to the url
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false ) {
        header("location: ../signup.php?error=emptyinput");
        exit(); // Stops the script from running
    }
    // If username is invalid redirect to signup page with an error attached
    if (invalidUid($username) !== false ) {
        header("location: ../signup.php?error=invaliduid");
        exit(); // Stops the script from running
    }
    // If email is invalid redirect to signup page with an error attached
    if (invalidEmail($email) !== false ) {
        header("location: ../signup.php?error=invalidemail");
        exit(); // Stops the script from running
    }
    // If passwords dont match redirect to signup page with an error attached
    if (pwdMatch($pwd, $pwdRepeat) !== false ) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit(); // Stops the script from running
    }
    // If username or email already exists redirect to signup page with an error attached
    if (uidExists($conn, $username, $email) !== false ) {
        header("location: ../signup.php?error=usernameormemailtaken");
        exit(); // Stops the script from running
    }

    createUser($conn, $name, $email, $username, $pwd);

}


else {//Return to index page     
    header("location: ../index.php");
    exit(); // Stops the script from running
*/

// Return user to front page if no errors
header("location: ../index.php?error=none");

}