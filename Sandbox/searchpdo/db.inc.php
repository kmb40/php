<?php 

        /* 
        // Original
        $this->servername = "localhost:8889";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "loginsystem";
        $this->charset = "utf8mb4";
        */

        $servername = "quikstarts.com:3306";
        $dbname = "quikstar_freedom";
        $dbusername = "quikstar_admin";
        $dbpassword = "marquis";
        $charset = "utf8mb4";
        $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=".$charset;

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // If there is an error, pass it to PDOException
            //echo "You succesfully connected to the database.";
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection Failed: ".$e->getMessage();
        }  
    

?>