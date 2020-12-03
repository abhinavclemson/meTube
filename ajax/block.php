<?php
require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {

    $blockedTo = $_POST['userTo'];
    $blockedBy = $_POST['userFrom'];

    // check if the user is block
    $query = $con->prepare("SELECT * FROM block WHERE blockedBy=:blockedBy AND blockedTo=:blockedTo");
    $query->bindParam(":blockedBy", $blockedBy);
    $query->bindParam(":blockedTo", $blockedTo);
    $query->execute();

    if($query->rowCount() == 0) {
        // Insert
        $query = $con->prepare("INSERT INTO block(blockedBy, blockedTo) VALUES(:blockedBy, :blockedTo)");
        $query->bindParam(":blockedBy", $blockedBy);
        $query->bindParam(":blockedTo", $blockedTo);
        $query->execute();
    }
    else {
        // Delete
        $query = $con->prepare("DELETE FROM block WHERE blockedBy=:blockedBy AND blockedTo=:blockedTo");
        $query->bindParam(":blockedBy", $blockedBy);
        $query->bindParam(":blockedTo", $blockedTo);
        $query->execute();
    }


}
else {
    echo "One or more parameters are not passed into block.php the file";
}

?>