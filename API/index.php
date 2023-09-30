<?php
#PHP API
#Ref - https://www.youtube.com/watch?v=LAb5yJRz0e0

#connect to the database
$conn = mysqli_connect("localhost:8889", "root", "root", "ooplogin"); // Login to specific db at host/port with username and password provided
 
$response = array();// Declare an array to hold results.

 if($conn) { // If db connection is succesful

    $sql = "SELECT * FROM gallery"; // Select all records from db gallery
    $result = mysqli_query($conn,$sql); // result variable is loaded with results of sql using the established db connection.

    if($result) { // If there is data contained in the db

        header("Content-Type: JSON");

        $i=0; //Create a counter varible

        while($row = mysqli_fetch_assoc($result)) {// Load db query results into an array
            $response[$i]['idGallery'] = $row ['idGallery'];
            $response[$i]['titleGallery'] = $row ['titleGallery'];
            $response[$i]['descGallery'] = $row ['descGallery'];
            $response[$i]['imgFullNameGallery'] = $row ['imgFullNameGallery'];
            $response[$i]['orderGallery'] = $row ['orderGallery'];
            $i++; //Plus one to variable
        }
        echo json_encode($response,JSON_PRETTY_PRINT);
    }

 } else {
    echo "DB connection failed";
    exit();
 }
?>