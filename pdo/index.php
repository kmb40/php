<?php

    include_once 'db.inc.php';
    include_once 'user.inc.php';

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
    $object = new User;
    echo "All Users:<br>";
    echo $object->getAllUsers();

    echo "<br>";

    echo "<br>Certain Users:<br>";
    echo $object->getUsersWithCountCheck();

    ?>
</body>
</html>