<?php
#error_reporting(0);

//Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["uploaded_file"]["name"]; // The file name
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; // The file in the PHP tmp folder
$fileType = $_FILES["uploaded_file"]["type"]; // The file type
$fileSize = $_FILES["uploaded_file"]["size"]; // The file size in bytes
$fileErrorMsg = $_FILES["uploaded_file"]["error"]; // 0 is false, 1 is true
$kaboom = explode(".",$fileName); // Split the file name into an array using the dot as a deliminator 
$fileExt = $kaboom[1]; // Target the second array element [1] to get he file extension 

//Start PHP Image Upload Error Handling
if(!$fileTmpLoc) {// If file is not choosen
    echo "Error: Please browse for a file before clicking the upload button.";
    exit();

} elseif ($fileSize > 5242880) { // If file size is larger than 5 MB
    echo "Error: Your file was larger than 5 MB in size.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} elseif (!preg_match("/\.(gif|jpg|png)$/i", $fileName)) {
    // This condition is only if you wish to allow uploading of specific file types
    echo "Error: Your file was not of type .gif, .jpg, or .png.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} elseif ($fileErrorMsg == 1) { // If file upload error key is equal to 1 (which is true)
    echo "Error: An error occured while processing the file. Try again before.";
    exit();
}

//Place the uploaded image into your "uploads" folder using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, "uploads/$fileName");

//Check to make sure the move result is true before continuing
if($moveResult != true) {
    echo "Error: File not uploaded. Try again.";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();

}
unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder

//Resizing
include_once("ak_php_img_lib.php"); // Contains resizing function
$target_file = "uploads/$fileName"; // Uploaded file to be resized
$resized_file = "uploads/resized_$fileName"; // The name that the resized file to take
$wmax = 200; // Width
$hmax = 150; // Height
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt); // Resize function called in ak_php_img_lib

// Display things to the page so you can see what is happening for testing purposes
echo "The file named <strong>$fileName</strong> uploaded successfully.<br/><br/>";
echo "It is <strong>$fileSize</strong> bytes in size.<br/><br/>";
echo "It is an <strong>$fileType</strong> type of file.<br/><br/>";
echo "The file extension is <strong>$fileExt</strong>.<br/><br/>";

?>