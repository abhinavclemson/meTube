<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Message.php");


//responseTo is not mandatory
if(isset($_POST['messageBy']) && isset($_POST['messageTo']) && isset($_POST['messageBody'])) {

    $userLoggedInObj = new User($con, $_SESSION["userLoggedIn"]);

    $query = $con->prepare("INSERT INTO messages(messageBy, messageTo, body) VALUES(:messageBy, :messageTo, :body)");
    $query->bindParam(":messageBy", $messageBy);
    $query->bindParam(":messageTo", $messageTo);
    $query->bindParam(":body", $messageText);

    $messageBy = $_POST['messageBy'];
    $messageTo = $_POST['messageTo'];

    //checking for responseTo id, with a ternary operator
    $messageText = $_POST['messageBody'];

    $query->execute();
    $newMessage = new Message($con, $con->lastInsertId(), $userLoggedInObj, $messageTo);
    echo $newMessage->create();
}
else {
    echo "One or more parameters are not passed into subscribe.php the file";
}

?>