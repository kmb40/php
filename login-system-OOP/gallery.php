<?php
    include_once('header.php');
?>

<section class="gallery-links">  
  <div class="container">
   <h2>Gallery</h2>  
    <div class="row">
        <?php 

        include_once 'includes/dba.inc.php'; // Call db connection code

        $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            echo '<div class="card-deck">';// Step up card deck

                while ($row = mysqli_fetch_assoc($result)) {
                 echo ' 
                    <div class="card" style="width: 18rem;">
                       <!-- <a href="#"> -->
                          <!-- <div style="background-image: url(img/gallery'.$row["imgFullNameGallery"].');"></div> -->
                           <img src="img/gallery'.$row["imgFullNameGallery"].'" class="card-img-top" /> 
                           <div class="card-body">
                           <h5 class="card-title">'.$row["titleGallery"].'</h5>
                           <p class="card-text">'.$row["descGallery"].'</p>
                    <!--  </a> -->
                      </div>
                    </div>';
                }

            echo '</div>';// Step up card deck   
        }
         ?>
     </div>
     <?php 
     if (isset($_SESSION['useruid'])) { // If user is not logged in - user id check - , do not show form
     echo '<br><div class="alert alert-dark" role="alert">
            <div class="gallery-upload">  
               <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data"> 
                   <input type="text" name="filename" placeholder="File Name...">
                   <input type="text" name="filetitle" placeholder="Image Title...">
                   <input type="text" name="filedesc" placeholder="Image description...">
                   <input type="file" name="file">
                   <button type="submit">Upload</button>
               </form>
            </div>
           </div>';
      }
     ?>
        </div>     
   </div>
</section>


<?php
    include_once('footer.php');
?>