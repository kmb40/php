<?php
    include_once('header.php');

    include "classes/dbh.classes.php"; // Handles database connectivity 
    include "classes/profileinfo.classes.php"; // Performs database queries 
    include "classes/profileinfo-contr.classes.php"; // Inserting data and making changes to the database
    include "classes/profileinfo-view.classes.php"; // Handles retrieving and displaying data from the database
    $profileInfo = new ProfileInfoView(); // Creates new object from View class profileinfo-view.classes.php
?>

<section>
    <div class="container">
      <div>
        <p><!-- Start Body content.//--></p>
        <?php
        if (isset($_SESSION["useruid"])){ // Check if a session exists with a useruid. If so, display profile and log out options on nav
            echo "<h1>Hello there " . $_SESSION["useruid"] . " you are logged in.</h1><br/>";
        }
        ?>
         <h2>
          <?php
              $profileInfo->fetchTitle($_SESSION["userid"]);
          ?> 
          </h2>
         <p><br/>
            <?php
              $profileInfo->fetchAbout($_SESSION["userid"]);
            ?> 
          </p>
        <p><!-- End body content. //--></p>
      </div>
    </div>
</section>

<?php
    include_once('footer.php');
?>