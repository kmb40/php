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
                'status' => 200,
                'message' => 'Customer Created Succesfully',
           ];
           header("HTTP/1.0 200 Created");
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

function getCustomerList() { // Create a complete customer list funciton which returns all cutomers. Altered to return quikstarts users

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

function getCustomer($customerParams){ // Create an indivudual customer function which returns a single cutomers. Altered to return a single quikstarts
    
    global $conn; // Declare dccon.php variable global

    // Error handling
    if($customerParams['id'] ==  null) { // If varible customerParams is empty

        return error422 ('Enter your customer id'); // Rund error hadnling function
    }

    $customerID = mysqli_real_escape_string($conn, $customerParams['id']); // establish db connection, look up customer id and remove any special characters from customer id

    $query = "SELECT * FROM tbl_users WHERE fld_id = '$customerID' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result) {

        if(mysqli_num_rows($result) == 1){

            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Customer Fetched Successfully',
                'data' => $res
           ];
           header("HTTP/1.0 200 Ok");
           return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display failure message 

        } else { // If the msqli_query fails, the display this error

            $data = [
                 'status' => 404,
                 'message' => 'No Customer Found',
            ];
            header("HTTP/1.0 404 No Customer Found");
            return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display failure message  
        }
    } else {// If the msqli_query fails, the display this error

            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
           ];
           header("HTTP/1.0 500 Internal Server Error");
           return json_encode($data, JSON_PRETTY_PRINT);  // Print / Display failure message  
    }
}

function updateCustomer($customerInput, $customerParams) { // Customer input function

    global $conn; // Declare dccon.php variable global

    if(!isset($customerParams['id'])) { // If customer id isnt found

        return error422 ('customer id not found in the URL');
    } elseif($customerParams['id'] == null  ) {

        return error422 ('Enter the customer id');
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);

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

        $query = "UPDATE tbl_users SET fld_firstname='$name', fld_email='$email', fld_adsense='$adsense' WHERE fld_id='$customerId' LIMIT 1";
        $result = mysqli_query($conn, $query);
    
        if($result) {

            $data = [
                'status' => 200,
                'message' => 'Customer Updated Succesfully',
           ];
           header("HTTP/1.0 200 Success");
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

?>