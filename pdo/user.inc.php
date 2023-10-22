<?php

class User extends Dbh {

 public function getAllUsers() {
        $stmt = $this->connect()->query("SELECT * FROM tbl_users LIMIT 10;");// Added limit (not required) to keep list short for testing. 
        while ($row = $stmt->fetch()) {

        echo $row["fld_username"] . "<br>";

    }
  }

  public function getUsersWithCountCheck() {
    $usersId = 36;
    $usersUid = "kmb40";
    $stmt = $this->connect()->prepare("SELECT * FROM tbl_users WHERE fld_id=? AND fld_username=?");
    $stmt->execute([$usersId, $usersUid]);

    if ($stmt->rowCount()) {
        while( $row = $stmt->fetch()) {
            return $row["fld_username"];
        }
    }

  }
}
?>