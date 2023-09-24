<?php

#if (isset($_POST["submit"])) {// (This method works also) Validate if the login form was used to reach this page, if not redirect to login.php page
if($_SERVER["REQUEST_METHOD"] == "POST") // (This method is considered best practice) Validate if the login form was used to reach this page, if not redirect to signup.php page
{
    $uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8'); // htmlspecialchars provides more secure method
   
    // Instantiate loginContr class at signup-contr-classes.php 
    include "../classes/dbh.classes.php"; // Include this file
    include "../classes/login.classes.php"; //Include this file
    include "../classes/login-contr.classes.php"; //Include this file
    $login = new LoginContr($uid, $pwd); //Assign a new instance of the object to variable $signup

    // Running error handles and user signup
    $login->loginUser();

    // Return user to front page if no errors
    header("location: ../index.php?error=none");

}
