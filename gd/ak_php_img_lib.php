<?php
// Function for resizing any .jpg .gif or .png image files
function ak_img_resize($target, $newcopy, $w, $h, $ext) {

    list($w_orig, $h_orig) = getimagesize($target); // Pulls the original width and height
    $scale_ratio = $w_orig / $h_orig; // Divide the original width by the original height then assign to scale_ratio

    if(($w / $h) > $scale_ratio) { // If the static resized width and heigth are greater than scale_ration then 
        $w = $h * $scale_ratio; // Static width is equal to static height times scale_ratio

    } else {
        $h = $w / $scale_ratio;// Static heigth is equal to static width times scale_ratio
    }
    $img = ""; // Declared as empty

    if($ext == "gif" || $ext == "GIF") { // If ext is gif then create gif
        $img = imagecreatefromgif($target);
    } elseif ($ext == "png" || $ext == "PNG") { // If ext is gif then create png
        $img = imagecreatefrompng($target);
    } else { // If ext is gif then create jpeg
        $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h); // Creates a black rectagle with spcified width and height

    // Takes 10 parameters - https://www.php.net/manual/en/function.imagecopyresampled.php
    imagecopyresampled($tci, $img, 0,0,0,0, $w, $h, $w_orig, $h_orig); // Copies
    imagejpeg($tci, $newcopy,80); // Saves the file
}
?>