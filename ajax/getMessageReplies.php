<?php
require_once("../includes/config.php");
require_once("../includes/classes/Message.php");
require_once("../includes/classes/User.php");


$messageBy = $_SESSION["userLoggedIn"]??"";
$messageTo = $_POST["messageTo"];



$userLoggedInObj = new User($con, $messageBy);
$profileUsernameObj = new User($con, $messageTo);

$message = new Message($con, $profileUsernameObj , $userLoggedInObj);

echo $message->getReplies();
?>