<?php

class Person {
    
    //properties
    public $name;
    public $eyeColor;
    public $age;
    
    //Constructor - Allows properties to be defined when objects are called
    public function __construct($passedName, $passedeyeColor, $passedAge){
        $this->name = $passedName;
        $this->eyeColor = $passedeyeColor;
        $this->age = $passedAge;
    }
    
    //methods
    public function setName($passedName) {
     $this->name = $passedName;   
        
    }
    
    //Destructor - cleans up after object by clearing memory of assigned property values
    public function __destruct(){
        
    }
}

?>