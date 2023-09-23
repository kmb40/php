<?php
// Handles database changes

class SignupContr extends Signup { //Contains properites aka variables and methods aka functions because this is an object

    //Set properties/variables for the class
    //Other options are protected and public. 
    # Ref https://stackoverflow.com/questions/4361553/what-is-the-difference-between-public-private-and-protected

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    // This method/function assigns     
    public function __construct($uid, $pwd, $pwdRepeat, $email)// These paramamters are capture from in the browser from the user and are not the same as the parameters/variables above
    {   
        // Set Class properties/variables to values captured from browser/user.
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    // Create user is all criteria is met
    public function signupUser() {
        if($this->emptyInput() == false) {
           // echo "Empty input!"; 
           header("location: ../index.php?error=emptyinput");
           exit();
        }
        if($this->invalidUid() == false) {
            // echo "Invalid username!"; 
            header("location: ../index.php?error=invalidusername");
            exit();
         }
        if($this->invalidEmail() == false) {
           // echo "Invalid email!"; 
           header("location: ../index.php?error=invalidemail");
           exit();
        }
        if($this->pwdMatch() == false) {
            // echo "Password dont match!"; 
            header("location: ../index.php?error=passwordmatch");
            exit();
         }
        if($this->uidTakenCheck() == false) {
           // echo "Username or Email taken!"; 
           header("location: ../index.php?error=useroremailtaken");
           exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    // Checking for empty fields
    private function emptyInput() {
        $result = "";
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result =  false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    // If username is invalid redirect to signup page with an error attached
    private function invalidUid() {
            $result = ""; // declare the var
            // If username doesnt match values, "result" equals false
            if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } 
        else {
            $result = true; // If username matches values, "result" equals true
          }
          return $result; // Return "result" value
    }//End of function

    // If email is invalid redirect to index page with an error attached
    private function invalidEmail() {
        $result = ""; // declare the var
        // If invalide email, "result" equals fales
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $result = false;
    } 

    else {
        $result = true; // If valid email, "result" equals false
      }
      return $result; // Return "result" value
    }//End of function

    // If passwords do not match redirect to signup page with an error attached
    private function pwdMatch() {
        $result = ""; // declare the var
        // If passwords dont match, "result" equals true
        if ($this->pwd !== $this->pwdRepeat) {
        $result = false;
    } 

    else {
        $result = true; // If passwords match, "result" equals true
      }
      return $result; // Return "result" value
    }//End of function

    // Check if username or email does not already exists
    private function uidTakenCheck() {
        $result = ""; // declare the var
        // If username or password dont exist, "result" equals false
        if (!$this->checkUser($this->uid, $this->email)) {// Avaialbe because this class extends/leverages Signup class
        $result = false;
    } 

    else {
        $result = true; // If username or password do exist, "result" equals true
      }
      return $result; // Return "result" value
    }//End of function    
}