<?php
require_once("../includes/config.php");
require_once("../includes/classes/Message.php");
require_once("../includes/classes/User.php");

$username = $_SESSION["userLoggedIn"]??"";
$profileUsername = $_POST["username"];
$commentId = $_POST["commentId"];


$userLoggedInObj = new User($con, $username);
$profileUsernameObj = new User($con, $username);

$message = new Message($con,$commentId, $profileUsernameObj , $userLoggedInObj,);

echo $message->getReplies();
?>