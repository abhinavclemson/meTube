<?php
require_once("includes/config.php");
require_once("includes/classes/Constants.php");

class Account
{
    private $con;
    private $errorArray = array();

    public function __construct($con)
    {
        $this->con = $con;

    }
    public function login($un, $pw){
        $pw = hash("sha512",$pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindParam(":un",$un);
        $query->bindParam(":pw",$pw);

        $query->execute();

        if($query->rowCount()==1){
            return true;
        }
        else{
            array_push($this->errorArray,Constants::$LoginFailed);
            return false;
        }
    }
    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
            $this->validateEmails($em,$em2);
            $this->validatePasswords($pw,$pw2);

            if(empty($this->errorArray)){
                return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
            }
            else{
                return false;
            }


    }

    public function insertUserDetails($fn, $ln, $un, $em, $pw){
            $pw = hash("sha512", $pw);
            $profilePic ="assets/images/profilePictures/Default.png";

            $query = $this->con->prepare("INSERT INTO users 
                                        (firstName, lastName, username, email, password, profilePic)
                                        VALUES(:fn, :ln, :un, :em, :pw, :pic)");

            $query->bindParam(":fn",$fn);
            $query->bindParam(":ln", $ln);
            $query->bindParam(":un", $un);
            $query->bindParam(":em", $em);
            $query->bindParam(":pw", $pw);
            $query->bindParam(":pic", $profilePic);

            return $query->execute();

    }

    private function validateFirstName($fn){
        if(strlen($fn)>25 || strlen($fn)<2){
            array_push($this->errorArray,Constants::$firstNameCharacters);
        }

    }
    private function validateLastName($ln){
        if(strlen($ln)>25 || strlen($ln)<2){
            array_push($this->errorArray,Constants::$lastNameCharacters);
        }

    }
    private function validateUsername($un){
        if(strlen($un)>25 || strlen($un)<5){
            array_push($this->errorArray,Constants::$UsernameCharacters);
            return;
        }
        $query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
        $query->bindParam(":un", $un);
        $query->execute();

        if($query->rowCount()!=0){
            array_push($this->errorArray, Constants::$UsernameTaken);
        }
    }

    private function validateEmails($em, $em2){
        if($em!=$em2){
            array_push($this->errorArray,Constants::$EmailsDoNotMatch);
            return;
        }
        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,Constants::$EmailsInvalid);
            return;
        }
        $query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
        $query->bindParam(":em", $em);
        $query->execute();

        if($query->rowCount()!=0){
            array_push($this->errorArray, Constants::$EmailTaken);
        }

    }
    private function validatePasswords($pw, $pw2){
        if($pw!=$pw2){
            array_push($this->errorArray,Constants::$PasswordsDoNotMatch);
            return;
        }

        if(preg_match("/[^A-Za-z0-9]/",$pw)){
            array_push($this->errorArray,Constants::$PasswordNotAlphanumeric);
            return;
        }

        if(strlen($pw)>25 || strlen($pw)<5){
            array_push($this->errorArray,Constants::$PasswordLength);
            return;
        }

    }




    public function getError($error){
        if(in_array($error, $this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }

}

?>

