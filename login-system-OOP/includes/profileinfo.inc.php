<?php
    session_start(); // Start a session so that logged in users can be recognized

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useruid"];
    $about = htmlspecialchars($_POST["about"], ENT_QUOTES, "UTF-8"); // htmlspecialchars provides more secure method
    $introTitle = htmlspecialchars($_POST["introtitle"], ENT_QUOTES, "UTF-8"); // htmlspecialchars provides more secure method
    $introText = htmlspecialchars($_POST["introtext"], ENT_QUOTES, "UTF-8"); // htmlspecialchars provides more secure method

    // Includes
    include "../classes/dbh.classes.php"; // Handles database connectivity 
    include "../classes/profileinfo.classes.php"; // Performs database queries 
    include "../classes/profileinfo-contr.classes.php"; // Inserting data and making changes to the database
    $profileInfo = new ProfileInfoContr($id, $uid); // Creates new object from View class profileinfo-contr.classes.php

    $profileInfo->updateProfileInfo($about, $introTitle, $introText);
    
    header("location: ../profilesettings.php?error=none");

}    