<?php
# This api reads / fetches data from the database

# https://bard.google.com/chat/dd9942d7d3de6479
header('Access-Control-Allow-Origin:*'); // Allow responses to incoming request to be shared with requesting code from any origin
header('Content-Type: application/json'); // Returns data in json format only
header('Access-Control-Allow-Method: GET'); // Only responds to GET request
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow_headers, Authorization, X-Request-Width');

// Leverage these files
include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"]; // Determines requestors request type (post,get,etc)


    if($requestMethod == "GET") { // If request if of type GET

        if(isset($_GET['id'])) { // If a a customer id is provided

            $customer = getCustomer($_GET); // Set variable customer to function getCustomer
            echo $customer; // Display customer

        } else {

            $customerList = getCustomerList(); // Set variable customerList to function getCustomerList
            echo $customerList; // Display customerList
        }

} else {

    // Throw a 405 error to the user in JSON
    $data = [
             'status' => 405,
             'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data, JSON_PRETTY_PRINT);    

}
  

?>