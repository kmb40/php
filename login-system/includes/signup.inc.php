<?php

if (isset($_POST["submit"])) {// Validate if the login form was used to reach this page, if not redirect to signup page
    //echo "It works";

    
}

else {
    header("location: ../signup.php");
}