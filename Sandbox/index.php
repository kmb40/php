<body>

<h1>browser</h1>
<?php /* gets the data from a URL */ ?>


<form action="browse.php" method="post">
url: <input type="text" name="url"><br>
<input type="submit">
</form>

Welcome <?php echo $_POST["url"]; ?><br>

</body>