<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Request method needs to be of type POST

    $userSearch = $_POST["usersearch"];
    /*
    if (is_integer($userSearch) == true) {
        echo "A number is required";
        exit();
    } else {
    */    
    try {
        
        require_once "db.inc.php";

        $query = "SELECT * FROM tbl_article WHERE fld_userid = :usersearch;";
        
        $stmt = $pdo->prepare($query); // Prepare query

        $stmt->bindParam(":usersearch", $userSearch); // Bind the db usersearch result to $userSeearch

        $stmt->execute(); // Execute on database

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);// Catch data from db query and pass into array

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
    
} else {
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <h3>Search Results</h3>
        <?php
            if(empty($results)) {

                echo "<div>";
                echo "<p>There were no results!</p>";
                echo "</div>";
            }
            else {
                //var_dump($results);
                
                foreach($results as $row) {
                    echo "Userid: ".htmlspecialchars($row["fld_userid"])."<br>";
                    echo "Guide Title: ".htmlspecialchars($row["fld_title"])."<br>";
                    echo "Publish Date: ".htmlspecialchars($row["fld_date"])."<br>";
                    echo "<br>";
                }
            }

        ?>
    </section>
</body>
</html>