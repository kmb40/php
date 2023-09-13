<?php

if (isset($_POST["submit"])) {// Validate if the login form was used to reach this page, if not redirect to signup page

    //echo "It works"; // Test the isset function
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dba.inc.php';    

    // Error hanlding and other functions
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

else {
    header("location: ../signup.php");
    exit(); // Stops the script from running
}