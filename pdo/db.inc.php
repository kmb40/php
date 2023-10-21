<?php 

class Dbh {

    // Properties
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    // Method
    public function connect(){
        $this->servername = "localhost:8889";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "loginsystem";
        $this->charset = "utf8mb4";

        try {
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // If there is an error, pass it to PDOException
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection Failed: ".$e->getMessage();
        }
    }
}

?>