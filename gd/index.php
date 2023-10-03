<?php
    
    $gdInfoArray =  gd_info();
    $version = $gdInfoArray["GD Version"];
    echo "Your GD version is: " . $version;

?>