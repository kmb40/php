<?php
    include_once('header.php');

    include "classes/dbh.classes.php"; // Handles database connectivity 
    include "classes/profileinfo.classes.php"; // Performs database queries 
    include "classes/profileinfo-contr.classes.php"; // Inserting data and making changes to the database
    include "classes/profileinfo-view.classes.php"; // Handles retrieving and displaying data from the database
    $profileInfo = new ProfileInfoView(); // Creates new object from View class profileinfo-view.classes.php
?>

<div class = "container">  
    <form action="includes/profileinfo.inc.php" method="post"> 
    <div class="form-group">
        <label for="exampleFormControlTextarea1">About</label>
        <textarea class="form-control" type="text" name="about" id="exampleFormControlTextarea1" rows="3"><?php $profileInfo->fetchAbout($_SESSION["userid"]);?></textarea>
      </div>        
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Title</label>
        <textarea class="form-control" type="text" name="introtitle" id="exampleFormControlTextarea2" rows="1"><?php $profileInfo->fetchTitle($_SESSION["userid"]);?></textarea>
      </div>        
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Text</label>
        <textarea class="form-control" type="text" name="introtext" id="exampleFormControlTextarea3" rows="3"><?php $profileInfo->fetchText($_SESSION["userid"]);?></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?php
    include_once('footer.php');
?>