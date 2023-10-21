<?php

    include_once 'db.Class.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
</head>
<body>
    <?php

    # print_r(PDO::getAvailableDrivers()); // Print out database drivers installed.
    $object = new Dbh;
    $object->connect();

    ?>
</body>
</html>