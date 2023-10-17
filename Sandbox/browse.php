<body>

<h1>browser</h1>
<?php /* gets the data from a URL 
https://superuser.com/questions/1326762/can-i-create-a-browser-within-a-website */
?>

<form action="browse.php" method="post">
url: <input type="text" name="url"><br>
<input type="submit">
</form>

url - https://<?php echo $_POST["url"]; ?><br>

<?php

$url = $_POST["url"];
$homepage = file_get_contents('h'.$url);
echo $homepage;

?>

</body>