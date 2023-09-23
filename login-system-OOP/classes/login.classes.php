<?php
// Handles database queries 


class Login extends Dbh {// A class which extends/uses the Dbh class

    // Login the user.
    // Leverage the method in the controller at login-contr-classes.php
    protected function getUser($uid, $pwd) {
        // Use prepred statement stmt (more secure). 
        // Also uses connect() method from Dbh since we extended this class. Then with this connect -> we query the db
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$stmt->execute(array($uid, $pwd))){ // If the sql portion of statement (stmt) fails to execute then return to index page. Used array because there is more than one parameter (uid and password)
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // If there are zero results from the db, throw and error then stop
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }
        
        // If there is a result, check for a match of the password in the db to the user submitted password. Return true if they match
        // FETCH_ASSOC returns passwords as an associative array
        # https://bard.google.com/chat/bae80f4b8b4e7298 

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]); //$pwdHashed[0]["users_pwd"] is used to refer to the multidimentional array FETCH_ASSOC.

        // If there are zerio results from the db, throw and error then stop
        if($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }    

        // Check everything where the username in the db is equal to what the user submited OR the users email is equal to what the user submited.
        elseif($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');

            if(!$stmt->execute(array($uid, $uid, $pwd))){ // If the sql portion of statement (stmt) fails to execute then return to index page. Used array because there is more than one parameter (uid and password)
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
               }

            // If there are zero results from the db, throw and error then stop
            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            // If there are results, login the user
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Start a session
            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];

            $stmt = null;
        }     
  
    }    

}