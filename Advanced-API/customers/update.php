<?php
# This api updatess data in the database
# https://www.youtube.com/watch?v=L9LrIW_3YgI&list=PLRheCL1cXHrtmbYl5LN733N9uSv-oU-UJ&index=4
# https://bard.google.com/chat/dd9942d7d3de6479
error_reporting(0);

header('Access-Control-Allow-Origin:*'); // Allow responses to incoming request to be shared with requesting code from any origin
header('Content-Type: application/json'); // Returns data in json format only
header('Access-Control-Allow-Method: PUT'); // Only responds to PUT request
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow_headers, Authorization, X-Request-Width');

// Leverage these files
include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"]; // Determines requestors request type (post,get,etc)

    if($requestMethod == "PUT") {

        $inputData = json_decode(file_get_contents("php://input"), true); // When storing data without a form (raw data). e.g. AJAX

        if(empty($inputData)) { // Important, this condition isnt used in the tutorial but requires a form and is commented out. The purpose of this effort is data manipulation via API and not forms.
            # https://youtu.be/L9LrIW_3YgI?list=PLRheCL1cXHrtmbYl5LN733N9uSv-oU-UJ&t=727
            
            $updateCustomer = updateCustomer($_POST, $_GET); // Updates form post content in variable storeCustomer

        } else {

            $updateCustomer = updateCustomer($inputData, $_GET); // Updates non form e.g. AJAX content in variable storeCustomer
        }

        echo $updateCustomer;// Dsiplay content in variable storeCustomer
        
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