<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Message.php");


//responseTo is not mandatory


if(isset($_POST['messageBy']) && isset($_POST['messageTo']) && isset($_POST['messageText']) ){


    $userLoggedInObj = new User($con, $_SESSION["userLoggedIn"]);
    $profileUsernameObj = new User($con, $_POST['messageTo']);


    $query = $con->prepare("INSERT INTO messages(messageBy, messageTo, body) VALUES(:messageBy, :messageTo, :body)");

    $query->bindParam(":messageBy", $messageBy);
    $query->bindParam(":messageTo", $messageTo);
    $query->bindParam(":body", $messageText);

    $messageBy = $userLoggedInObj->getUsername();
    $messageTo = $profileUsernameObj->getUsername();
    $messageText = $_POST['messageText'];


    $query->execute();




    $newMessage = new Message($con, $con->lastInsertId(),  $userLoggedInObj, $profileUsernameObj);

    echo $newMessage->create();
}

else
    {
    echo $_SESSION["userLoggedIn"];
}

?>