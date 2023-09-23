<?php
// Handles database queries 


class Signup extends Dbh {// A class which extends/uses the Dbh class

    // Check if the submitted username and password exists in the database.
    // Leverage the method in the controller at signup-contr-classes.php
    protected function checkUser($uid, $email) {
        // Use prepred statement stmt (more secure). 
        // Also uses connect() method from Dbh since we extended this class. Then with this connect -> we query the db
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$stmt->execute(array($uid, $email))){// If the sql portion of statement (stmt) fails to execute then return to index page. Used array because there is more than one parameter (uid and email)
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // Wont automtically return false if the execution fails.
        // So, check whether ANY rows are returned from the db query, then set to false because that means the username or email already exist
        $resultCheck = "";
        if($stmt->rowCount() > 0){// Counts how many rows were returned from the db and if more than 0 do...
            $resultCheck = false;
        }
        else {
            $resultCheck = true; // Means that it is true that the username or email do not exisit in db because no rows were returned
        }
        return $resultCheck;
    }

    // Create a new user.
    // Leverage the method in the controller at signup-contr-classes.php
    protected function setUser($uid, $pwd, $email) {
        // Use prepred statement stmt (more secure). 
        // Also uses connect() method from Dbh since we extended this class. Then with this connect -> we query the db
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');

        // Hash the password before inserting it
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uid, $hashedPwd, $email))){ // If the sql portion of statement (stmt) fails to execute then return to index page. Used array because there is more than one parameter (uid and email)
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }    

}