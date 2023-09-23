<?php
# Establishes a database connection
// Properties and a constructor are not required since this function is only establishing a db connection.

class Dbh {

    protected function connect() {// Protected (can be extended/leveraged by other classes) - Method/Function for connecting to db
        try { // Attempt to run code
            $username = "root"; // declare username for db
            $password = "root"; // declare password for db
            $dbh = new PDO('mysql:host=localhost:8889;dbname=ooplogin', $username, $password); // PHP Data Object
            # https://bard.google.com/chat/57a348ed6713c6eb 
            return $dbh;
        }
        catch (PDOException $e) {// If there is an error assign to to $e
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}