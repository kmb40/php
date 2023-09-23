<?php

if (isset($_POST["submit"])) {// Validate if the login form was used to reach this page, if not redirect to login.php page

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
   
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
