<?php

require '../inc/dbcon.php'; // Require dbcon.php file / contents

function error422 ($message) { // Error handling function

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storeCustomer($customerInput) { // Customer input function

    global $conn; // Declare dccon.php variable global

    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $adsense = mysqli_real_escape_string($conn, $customerInput['adsense']);

    // Error handling
    if(empty(trim($name))) {

        return error422 ('Enter your name');
    } elseif (empty(trim($email))) {
        # code...
        return error422 ('Enter your email');
    } elseif (empty(trim($adsense))) {
        # code...
        return error422 ('Enter your adsense');
    } else {

        $query = "INSERT INTO tbl_users (fld_firstname,fld_email,fld_adsense) VALUES ('$name','$email','$adsense')";
        $result = mysqli_query($conn, $query);
    
        if($result) {

            $data = [
                'status' => 201,
                'message' => 'Customer Created Succesfully',
           ];
           header("HTTP/1.0 201 Created");
           return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display success message 

        } else {

            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
           ];
           header("HTTP/1.0 500 Internal Server Error");
           return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display failure message  

        }

    }

}

function getCustomerList() { // Create a customer list funciton. Altered for quikstarts users

    global $conn; // Declare dccon.php variable global

    $query = "SELECT * FROM tbl_users";
    $query_run = mysqli_query($conn, $query);

    if($query_run) { // If a db connects and the query executes...

        if(mysqli_num_rows($query_run) > 0 ) { // If the number of rows is greater than one...

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC); // Push query results in an array having the fieldname as the array index.
           
            $data = [
                'status' => 200, // Sends status
                'message' => 'Customer List Fetched Successfully', // Sends status
                'data' => $res // Sends data
            ];
            header("HTTP/1.0 200 Ok");
            return json_encode($data, JSON_PRETTY_PRINT); // Print / Display success message

        } else { // If the msqli_query fails, the display this error

            $data = [
                'status' => 404,
                'message' => 'No Customer Found',
           ];
           header("HTTP/1.0 404 No Customer Found");
           return json_encode($data, JSON_PRETTY_PRINT); // Print / Display state message        
   
       }

    } else { // If the msqli_query fails, the display this error

         $data = [
             'status' => 500,
             'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display failure message       

    }
}

?>