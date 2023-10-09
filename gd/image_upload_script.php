<?php
#error_reporting(0);

//Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName = $_FILES["uploaded_file"]["name"]; // The file name
$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; // The file in the PHP tmp folder
$fileType = $_FILES["uploaded_file"]["type"]; // The file type
$fileSize = $_FILES["uploaded_file"]["size"]; // The file size in bytes
$fileErrorMsg = $_FILES["uploaded_file"]["error"]; // 0 is false, 1 is true
#$fileName = preg_replace('#[^a-z.0-9]#i','',$fileName);// OPTIONAL - Filter the filename of anything but numbers or letters
$kaboom = explode(".",$fileName); // Split the file name into an array using the dot as a deliminator 
$fileExt = $kaboom[1]; // Target the second array element [1] to get he file extension 
#$fileName = time().rand().''.''.$fileExt;// OPTIONAL - Provide a unique random filename using the time and random number
#$fileTypeTrue = mime_content_type($_FILES["uploaded_file"]["tmp_name"]); // Determine true file type

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

//Include functions
include_once("ak_php_img_lib.php"); // Contains resizing function

//Resizing
$target_file = "uploads/$fileName"; // Uploaded file to be resized
$resized_file = "uploads/resized_$fileName"; // The name that the resized file to take
$wmax = 200; // Width boundary
$hmax = 150; // Height boundary
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt); // Resize function called in ak_php_img_lib

// Rotate
$target_file = "uploads/$fileName"; // Uploaded file to be resized
$rotated_file = "uploads/rotated_$fileName"; // The name that the resized file to take
kb_img_rotate($target_file, $rotated_file); // Calling function and passign parameters

//Thumbnail
// Be advised that there appear to be issues when creating thumbnails for transparent png and gif files
$target_file = "uploads/resized_$fileName"; // Uploaded resized file to be thumbed
$thumbnail = "uploads/thumb_$fileName"; // The name that the thumbed file
$wthumb = 150; // Width boundary
$hthumb = 150; // Height boundary
if ($fileExt == "gif" || $fileExt == "png"){ // This condition sources the original instead of the resized image. The resized image causes the imagecreatefrompng and imagecreatefromgif to fail like due to size
    $target_file = "uploads/".$fileName;
    ak_img_thumb($target_file, $thumbnail, $wthumb, $hthumb, $fileExt);
} else {
    ak_img_thumb($target_file, $thumbnail, $wthumb, $hthumb, $fileExt);
}

//Convert non jpg to jpg
if(strtolower($fileExt) != "jpg") {
    // This could be used prior to the thumbnail function which fails for transparent files of a certain size. E.g. If gif or png, convert to jpg then thumbnail
    echo "This aint no jpg yo! We are going to convert so that a thumbnail can be created.";
    $target_file = "uploads/".$fileName; // This sources the original instead of the resized image. The resized image causes the imagecreatefrompng and imagecreatefromgif to fail like due to size
    $new_jpg = "uploads/".$kaboom[0].".jpg";
    ak_img_convert_to_jpg($target_file, $new_jpg, $fileExt);

}

// Watermark feature
# Needs to be run AFTER jpg conversion function
$target_file = "uploads/".$kaboom[0].".jpg";
$wtrmrk_file = "watermark.png";
$new_file = "uploads/protected_".$kaboom[0].".jpg";
ak_img_watermark($target_file, $wtrmrk_file, $new_file);

// Display things to the page so you can see what is happening for testing purposes
echo "The file named <strong>$fileName</strong> uploaded successfully.<br/><br/>";
echo "It is <strong>$fileSize</strong> bytes in size.<br/><br/>";
echo "It is an <strong>$fileType</strong> type of file.<br/><br/>";
echo "The file extension is <strong>$fileExt</strong>.<br/><br/>";
?>