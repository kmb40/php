<?php
    include_once('header.php');
?>

<section>
    <h2>Log in Page</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="name" placeholder="Username/Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Log in</button>
    </form>
</section>

<?php
    include_once('footer.php');
?>