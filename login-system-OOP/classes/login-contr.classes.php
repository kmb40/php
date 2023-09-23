<?php
// Handles database changes

class LoginContr extends Login { //Contains properites aka variables and methods aka functions because this is an object

    //Set properties/variables for the class
    //Other options are protected and public. 
    # Ref https://stackoverflow.com/questions/4361553/what-is-the-difference-between-public-private-and-protected

    private $uid;
    private $pwd;


    // This method/function assigns     
    public function __construct($uid, $pwd)// These paramamters are capture from in the browser from the user and are not the same as the parameters/variables above
    {   
        // Set Class properties/variables to values captured from browser/user.
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    // Create user is all criteria is met
    public function loginUser() {
        if($this->emptyInput() == false) {
           // echo "Empty input!"; 
           header("location: ../index.php?error=emptyinput");
           exit();
        }

        $this->getUser($this->uid, $this->pwd);
    }

    // Checking for empty fields
    private function emptyInput() {
        $result = "";
        if(empty($this->uid) || empty($this->pwd)) {
            $result =  false;
        }
        else {
            $result = true;
        }
        return $result;
    }
   
}