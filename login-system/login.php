<?php
    include_once('header.php');
?>

<section>
    <h2>Log in Page</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="name" placeholder="Username/Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Log in</button>
    </form>

<?php
// Alert the user whether they have completed form submission correctly or not
// Check whether a certain url exist inside of the url field
if (isset($_GET["error"])) {// $_GET checks url data that can be seen. e.g. 123.php?error=something. $_POST check url data that cannot be seen
    if ($_GET["error"] == "emptyinput") {
      echo "<p>Fill in all fields!</p>";  
    }
    else if ($_GET["error"] == "wronglogin") {
        echo "<p>Incorrect username!</p>";  
      }
    else if ($_GET["error"] == "wrongpassword") {
      echo "<p>Incorrect password!</p>";  
    }     
}
?>    
</section>

<?php
    include_once('footer.php');
?>