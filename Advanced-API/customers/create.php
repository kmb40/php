<?php
# This api creates / inserts data from the database
# https://www.youtube.com/watch?v=h4VzePleFk8&list=PLRheCL1cXHrtmbYl5LN733N9uSv-oU-UJ&index=2
# https://bard.google.com/chat/dd9942d7d3de6479
error_reporting(0);

header('Access-Control-Allow-Origin:*'); // Allow responses to incoming request to be shared with requesting code from any origin
header('Content-Type: application/json'); // Returns data in json format only
header('Access-Control-Allow-Method: POST'); // Only responds to POST request
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow_headers, Authorization, X-Request-Width');

// Leverage these files
include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"]; // Determines requestors request type (post,get,etc)

    if($requestMethod == "POST") {

        $inputData = json_decode(file_get_contents("php://input"), true); // When storing data without a form (raaw data). e.g. AJAX

        if(empty($inputData)) {

            echo $_POST['name']; // Display data for name 
            $storeCustomer = storeCustomer($_POST); // Stores form post content in variable storeCustomer

        } else {

            $storeCustomer = storeCustomer($inputData); // Stores non form e.g. AJAX content in variable storeCustomer
        }

        echo $storeCustomer;// Dsiplay content in variable storeCustomer
        
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