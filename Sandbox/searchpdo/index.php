<?php

    include_once 'db.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
</head>
<body>
<section>
    <?php
   echo var_dump($pdo);

    ?>
        <form action="search.php" method="post">
            <input id="search" type="text" placeholder="Search for guides by username" name="usersearch">
            <button>GO</button>
        </form>
    </section>
</body>
</html>