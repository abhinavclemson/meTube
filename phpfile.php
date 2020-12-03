<?php
require_once("includes/header.php");
require_once("includes/classes/MessageSection.php");


if(isset($_GET["username"])) {
    $profileUsername = $_GET["username"];
}
else {
    echo "Channel not found";
    exit();
}
?>

<?php
$messageSection = new MessageSection($con, $profileUsername, $userLoggedInObj);
echo $messageSection->create();
?>

<?php require_once("includes/footer.php"); ?>
