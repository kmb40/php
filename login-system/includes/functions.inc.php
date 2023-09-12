<?php

// If any input fields are empty "result" equals true
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result = ""; // declare the var
    // If any of these values are empty, "result" equals true
    if (empty($name)|| empty($email)|| empty($username) || empty($pwd)|| empty($pwdRepeat)) {
    $result = true;
} 

else {
    $result = false; // If all of these values are not empty, "result" equals false
  }
  return $result; // Return "result" value

} //End of function

// If username is invalid redirect to signup page with an error attached
function invalidUid($username) {
    $result = ""; // declare the var
    // If any of these values are empty, "result" equals true
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
} 

else {
    $result = false; // If all of these values are not empty, "result" equals false
  }
  return $result; // Return "result" value
}//End of function

// If email is invalid redirect to signup page with an error attached
function invalidEmail($email) {
    $result = ""; // declare the var
    // If any of these values are empty, "result" equals true
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
} 

else {
    $result = false; // If all of these values are not empty, "result" equals false
  }
  return $result; // Return "result" value
}//End of function

// If passwords do not match redirect to signup page with an error attached
function pwdMatch($pwd, $pwdRepeat) {
    $result = ""; // declare the var
    // If any of these values are empty, "result" equals true
    if ($pwd !== $pwdRepeat) {
    $result = true;
} 

else {
    $result = false; // If all of these values are not empty, "result" equals false
  }
  return $result; // Return "result" value
}//End of function

// If username or email already exists redirect to signup page with an error attached
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE userUid = ? OR usersEmail = ?;";// Query database for username and password
    $stmt = mysqli_init($conn); // Initializes prepated statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");     
    exit();   

    }
    //
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

}//End of function
