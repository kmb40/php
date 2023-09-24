<?php
    include_once('header.php');
?>

<section>
    <div class="container">
      <div>
        <p><!-- Start Body content.//--></p>
        <?php
        if (isset($_SESSION["useruid"])){ // Check if a session exists with a useruid. If so, display profile and log out options on nav
            echo "<h1>Hello there " . $_SESSION["useruid"] . " you are logged in.</h1>";
        }
        ?>
        <h1>This is your profile page.</h1>
          <p>This is all about you.</p>
        <p><!-- End body content. //--></p>
      </div>
    </div>
</section>

<?php
    include_once('footer.php');
?>