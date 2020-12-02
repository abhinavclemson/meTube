<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);
if(isset($_POST["submitButton"]) ){

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful =$account->login($username,$password);

    if($wasSuccessful){
        //Success
        //Redirect user to index page

        //Creating the session variable
        $_SESSION["userLoggedIn"] = $username;

        //to redirect to index.php
        header("Location: index.php");

        echo "Success!";
    }
    else{
        echo "Fail!";
    }

}

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}


?>
<!DOCTYPE html>

<html>
<head>
    <title>MeTube</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/commonActions.js"></script>

</head>


<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="https://img.icons8.com/material-two-tone/48/000000/video.png" title="me
    tube" alt="meTube"/>
                <h3>Sign In</h3>
                to continue to MeTube

            </div>
            <div class="loginForm">
                <form action="signin.php" method="POST">

                    <?php echo $account->getError(Constants::$LoginFailed) ?>
                    <input type="text" name="username" placeholder="Username" value ="<?php getInputValue('username'); ?>" required>


                    <input type="password" name="password" placeholder="password"  required>
                    <input type="submit" name="submitButton" value="Submit">

                </form>


            </div>
            <a class="signInMessage" href="signup.php">Need an account? Sign Up here!</a>
        </div>

    </div>