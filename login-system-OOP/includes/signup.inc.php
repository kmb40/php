<?php

#if (isset($_POST["submit"])) {// (This method works also) Validate if the login form was used to reach this page, if not redirect to signup.php page
if($_SERVER["REQUEST_METHOD"] == "POST") // (This method is considered best practice) Validate if the login form was used to reach this page, if not redirect to signup.php page
{

    // Capturing data from signup form on the index page
    $uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method
    $pwdRepeat = htmlspecialchars($_POST["pwdRepeat"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method

    // Instantiate SignContr class at signup-contr-classes.php 
    include "../classes/dbh.classes.php"; // Include this file
    include "../classes/signup.classes.php"; //Include this file
    include "../classes/signup-contr.classes.php"; //Include this file
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email); //Assign a new instance of the object to variable $signup

    // Running error handles and user signup
    $signup->signupUser();
    
    $userId = $signup->fetchUserId($uid);

    // Instantiate ProfileInfoContr class at profileinfo-contr-classes.php 
    include "../classes/profileinfo.classes.php"; // Include this file
    include "../classes/profileinfo-contr.classes.php"; //Include this file
    $profileInfo = new ProfileInfoContr($userId, $uid);
    $profileInfo->defaultProfileInfo();

    // Return user to front page if no errors
    header("location: ../index.php?error=none");

}