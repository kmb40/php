<?php

class User extends Dbh {

 public function getAllUsers() {
        $stmt = $this->connect()->query("SELECT * FROM users");
        while ($row = $stmt->fetch()) {

        echo $row["usersUid"] . "<br>";

    }
  }

  public function getUsersWithCountCheck() {
  
    $usersId = 2;
    $usersUid = "kmb40";
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usersId=? AND usersUid=?");
    $stmt->execute([$usersId, $usersUid]);

    if ($stmt->rowCount()) {
        while( $row = $stmt->fetch()) {
            return $row["usersUid"];
        }
    }

  }
}
?>