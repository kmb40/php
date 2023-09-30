<?php

if($_SERVER["REQUEST_METHOD"] == "POST") // (This method is considered best practice) Validate if the submit form was used to reach this page, if not 
{

    $newFileName = $_POST['filename']; // Set submitted name to variable
    
    if (empty($newFileName)) { // If no data is submitted name the file "gallery"
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName)); // replace spaces with a - and make name lowercase
    }

    $imageTitle = $_POST['filetitle']; // Set submitted title to variable
    $imageDesc = $_POST['filedesc']; // Set submitted description to variable

    $file = $_FILES['file'];

    /*
    print_r($file); // display an array of the files var, useful for testing
    exit();
    */

    // Error handling and other use
    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName); // separate the files etension from the name
    $fileActualExt = strtolower(end($fileExt)); // Grab the file extension 

    $allowed = array("jpg","jpeg","png"); // Assign these extensions to variable

    if(in_array($fileActualExt, $allowed)) { // If file has accepted extension 

        if($fileError === 0) { // 0 means there are no errors

            if($fileSize < 2000000) { // If file is less than 2? state this message
              $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt; // On succesful upload if criteria are met create random name
              $fileDestination = "../img/gallery" . $imageFullName; // File destination

              include_once "dba.inc.php"; // Connect to db
              
              if (empty($imageTitle) || empty($imageDesc)) { // If either of these is empty return to upload page with error
                header("Location: ../gallery.php?upload=empty");
                exit();
              } else { // If these is not empty, return to upload page with error
                $sql = "SELECT * FROM gallery;";
                $stmt = mysqli_stmt_init($conn); // Set up prepared statement

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL Statement failed";
                } else {

                   // Prepared Staement
                   mysqli_stmt_execute($stmt);
                   $result = mysqli_stmt_get_result($stmt);
                   $rowCount = mysqli_num_rows($result);
                   $setImageOrder = $rowCount + 1;

                   $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES ( ?, ?, ?, ?);";
                   if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL Statement failed";
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                    mysqli_stmt_execute($stmt);

                    move_uploaded_file($fileTempName, $fileDestination);
                    header("Location: ../gallery.php");
                }
                }
              }

            } else {
                echo "File size is too big!";
                exit();
            }

        } else{
            echo "You had an error!";  
            exit();
        }
    } else {
        echo "You need to upload a proper file type!";
        exit();
    }
}
?>