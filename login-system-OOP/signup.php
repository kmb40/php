<?php
    include_once('header.php');
?>

<section>
    <h2>Signup Page</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Full name...">
        <input type="text" name="email" placeholder="Email...">
        <input type="text" name="uid" placeholder="Username...">
        <input type="password" name="pwd" placeholder="Password...">
        <input type="password" name="pwdrepeat" placeholder="Repeat Password...">
        <button type="submit" name="submit">Sign up</button>
    </form>

<?php
// Alert the user whether they have completed form submission correctly or not
// Check whether a certain url exist inside of the url field
if (isset($_GET["error"])) {// $_GET checks url data that can be seen. e.g. 123.php?error=something. $_POST check url data that cannot be seen
    if ($_GET["error"] == "emptyinput") {
      echo "<p>Fill in all fields!</p>";  
    }
    else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";  
      }
    else if ($_GET["error"] == "invalidemail") {
      echo "<p>Choose a proper email!</p>";  
    }
    else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords dont match!</p>";  
      }
    else if ($_GET["error"] == "stmtfailed") {
      echo "<p>Something went wrong, try again!</p>";  
    } 
    else if ($_GET["error"] == "usernameormemailtaken") {
        echo "<p>Username or email already taken!</p>";  
      }  
    else if ($_GET["error"] == "none") {
      echo "<p>Your sign up was successful!</p>";  
    }        
}
?>    
</section>

<?php
    include_once('footer.php');
?>