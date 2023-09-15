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
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";// Query database for username and password
    $stmt = mysqli_stmt_init($conn); // Initializes prepated statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");     
    exit();   

    }
    //Binds parameters to the prepared statement stmt
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    
    //Execute the statement
    mysqli_stmt_execute($stmt);

    // Returns data if exists 
    $resultData = mysqli_stmt_get_result($stmt);

    // Check to see if any data gets returned 
    if ($row = mysqli_fetch_assoc($resultData)) {
      // Return all of the data if the user exists
      return $row;
    }

    else {
      // If this function fails to return a match, then return a value of false
      $result = false;
      return $result;
    }
    // Clost the prepared statement 
    mysqli_stmt_close($stmt);
}//End of function

// If any input fields are empty "result" equals true
function emptyInputLogin($username, $pwd) {
  // If any of these values are empty, "result" equals true
  if (empty($username) || empty($pwd)) {
  $result = true;
  } 
}

// If username or email does not already exists, create / insert into the database
function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";// Insert new user into database
    $stmt = mysqli_stmt_init($conn); // Initializes prepated statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");     
    exit();   

    }
    // Encrypt the password
    //$pwd = '';
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    //Binds parameters to the prepared statement stmt
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    
    //Execute the statement
    mysqli_stmt_execute($stmt);

    // Clost the prepared statement 
    mysqli_stmt_close($stmt);
    
    // Send the user with the new account to signup page with no error
    header("location: ../signup.php?error=none");     
    exit(); 

    // Log the user into the system
    // Describe here
    function loginUser($conn, $username, $pwd) {
      $uidExists = uidExists($conn, $username, $username);// Assign the uidExists function and paramters to variable uidExist

      // If uidExists parameters failed to populate then throw error and redirect to login
      if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");     
        exit(); 
    }
    
    // Check the password supplied at login against the password stored in the db correlated to the provided username
    $pwdHashed = $uidExists["usersPwd"]; //Check existing pwd
    $checkPwd = password_verify($pwd, $pwdHashed); // Compare provided password with existing password
  
    if ($checkPwd === false) {
      header("location: ../login.php?error=wrongpassword");     
      exit(); 

    }
    else if ($checkPwd === true) {
     session_start(); // Start a login session
     $_SESSION["userid"] = $uidExists["usersid"]; //Create super globals variable for session
     $_SESSION["useruid"] = $uidExists["usersUid"]; //Create super globals variable for session
     header("location: ../index.php"); // Send logged in user to home page    
     exit(); 
    }
  }
}//End of function

// Illustrate links that reflect logged in vs not logged in
// User logged in wrong errors