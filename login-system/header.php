<?php
    session_start(); // Start a session so that logged in users can be recognized on every page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Login System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
        <nav>
            <div>
                <a href="index.php"><img src="img/logo.png" alt="logo"></a>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="discover.php">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                
                <?php
                    // Illustrate links that reflect logged in vs not logged in
                    if (isset($_SESSION["useruid"])){ // Check if a session exists with a userid.
                        echo "<li><a href='profile.php'>Profile Page</a></l1>";
                        echo "<li><a href='includes/logout.inc.php'>Log Out</a></l1>";
                    }
                    else {
                        echo "<li><a href='signup.php'>Sign Up</a></li>";
                        echo "<li><a href='login.php'>Log In</a></li>";
                    }
                ?>
                </ul>
            </div>
        </nav>
    <body>
        <div><!-- Opening body div //-->
End of Header Content <br/>