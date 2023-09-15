<?php
    include_once('header.php');
?>

<section>

<p><!-- Start Body content.//--></p>
        <?php
        if (isset($_SESSION["useruid"])){ // Check if a session exists with a useruid. If so, display profile and log out options on nav
            echo "<h1>Hello there " . $_SESSION["useruid"] . "</h1>";
        }
        ?>
        <h1>This is an Research and Development for PHP</h1>
          <p>The objective is to practice coding with an actual project while documenting the process to internalize the knowledge.</p>
        <p><!-- End body content. //--></p>
    <br/>
</section>

<?php
    include_once('footer.php');
?>