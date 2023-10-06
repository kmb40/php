<?php

    #phpinfo();
    #echo sys_get_temp_dir(); // Path to temp dir . Actaully located in Applications/Mamp/tmp/php
    $gdInfoArray =  gd_info();
    $version = $gdInfoArray["GD Version"];
    echo "Your GD version is: " . $version;
    echo "</hr>";
    foreach ($gdInfoArray as $key => $value){
        echo "$key | $value<br/>";
    }

?>
<hr>
<form enctype="multipart/form-data" method="post" action="gd/image_upload_script.php"> 
Choose your file here:
<input name="uploaded_file" type="file"/><br/><br/>
<input type="submit" value="Upload it"/>
</form>