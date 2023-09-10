<html>
    <h1>Testing Shit</h1>

<body>
This section contains a basic Class:    
<?php
include 'inc/basicClass.inc.php';// Leverages the basic class 

$holder4Basic = New Basic;
echo $holder4Basic->info;

//var_dump($object); //Displays the entire contents of $object . Good for debugging.

?>

<br><br>
This section contains a Class that has a constructor:   

<?php
    include 'inc/class.inc.php';// Leverages Person class
    $person1 = New Person("Kyle", "Brown", "52"); // Creates new Person Object with paramaters and assigns to variable "person1"
    echo $person1->name;
    echo $person1->eyeColor;
    
    $person1 ->setName("Marquis");
    echo $person1->name;
    //echo $person1->age; 
   /*
    $person1->setName("Kyle"); // Sets class name property to "Kyle"
    echo 'The name is <b>'.$person1->name.'</b><br/>'; // Prints the value of person1 to screen
    
    $person1 = New Person(); // Creates new Person Object and assigns to variable "person1"
    $person1->setName("Tina"); // Sets class name property to "Kyle"
    echo 'The name is <b>'.$person1->name.'</b>'; // Prints the value of person1 to screen
    */
?>
</body>
</html>