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
    imagecopyresampled($tci, $img, 0,0,0,0, $w, $h, $w_orig, $h_orig); // Copies image
    imagejpeg($tci, $newcopy,80); // Saves the file Imagejpeg outputs gif and png without issue
}
    // Thumbnail Function
    function ak_img_thumb($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target); // Pulls the original width and height

    $src_x = ($w_orig /2) - ($w/2);
    $src_y = ($h_orig /2) - ($h/2);
    $ext = strtolower($ext);

    $img = ""; // Declared as empty

    if($ext == "gif") { // If ext is gif then create gif
        $img = imagecreatefromgif($target);
    } elseif ($ext == "png") { // If ext is gif then create png
        $img = imagecreatefrompng($target);
    } else { // If ext is gif then create jpeg
        $img = imagecreatefromjpeg($target);
    } 

    $tci = imagecreatetruecolor($w, $h); // Creates a black rectagle with specified width and height   

    /* Testing a resolution to the transparency issue for gif and png
    // preserve transparency
    if($ext == "gif" or $ext == "png") {
      imagecolortransparent($tci, imagecolorallocatealpha($tci, 0, 0, 0, 127));
      imagealphablending($tci, false);
      imagesavealpha($tci, true);
    }*/
    
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h); // Copies   
    imagejpeg($tci, $newcopy,80); // Saves the file Imagejpeg outputs gif and png without issue
    
    if($ext == "gif") { // If ext is gif then create gif
        imagegif($tci, $newcopy);
    } elseif ($ext == "png") { // If ext is gif then create png
        imagepng($tci, $newcopy);
    } else { // If ext is gif then create jpeg
        imagejpeg($tci, $newcopy, 84); // Saves the file.  
    } 
}

// Function for converting
function ak_img_convert_to_jpg($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target); // Pulls the original width and height
    $ext = strtolower($ext); // Make all lowercase
    $img = ""; // Declared as empty
    if($ext == "gif") {
        $img = imagecreatefromgif($target);

    } elseif ($ext == "png") {
        $img = imagecreatefrompng($target); {

        }
        $tci = imagecreatetruecolor($w_orig, $h_orig); // Creates a black rectagle with specified width and height  
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig); // Copies image
        imagejpeg($tci, $newcopy, 84); // Saves the file as a jpeg 
    }
}
?>