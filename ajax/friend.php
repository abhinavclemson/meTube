<?php
require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {

    $fname = $_POST['userTo'];
    $username = $_POST['userFrom'];

    // check if the user is friend
    $query = $con->prepare("SELECT * FROM friend WHERE username=:username AND fname=:fname");
    $query->bindParam(":username", $username);
    $query->bindParam(":fname", $fname);
    $query->execute();

    if($query->rowCount() == 0) {
        // Insert
        $query = $con->prepare("INSERT INTO friend(username, fname) VALUES(:username, :fname)");
        $query->bindParam(":username", $username);
        $query->bindParam(":fname", $fname);
        $query->execute();

        $query = $con->prepare("INSERT INTO friend(username, fname) VALUES(:fname, :username)");

        $query->bindParam(":username", $username);
        $query->bindParam(":fname", $fname);
        $query->execute();
    }
    else {
        // Delete
        $query = $con->prepare("DELETE FROM friend WHERE username=:username AND fname=:fname");
        $query->bindParam(":username", $username);
        $query->bindParam(":fname", $fname);
        $query->execute();

        $query = $con->prepare("DELETE FROM friend WHERE username=:fname AND fname=:username");

        $query->bindParam(":username", $username);
        $query->bindParam(":fname", $fname);
        $query->execute();
    }


}
else {
    echo "One or more parameters are not passed into friend.php the file";
}

?>