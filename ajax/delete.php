<?php
require_once("../includes/config.php");

if(isset($_POST['videoId'])) {

    $videoId = $_POST['videoId'];

    // check if the user is subbed
    $query = $con->prepare("DELETE FROM videos WHERE id=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();

    $query = $con->prepare("DELETE FROM likes WHERE videoId=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();

    $query = $con->prepare("DELETE FROM dislikes WHERE videoId=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();

    $query = $con->prepare("DELETE FROM thumbnails WHERE videoid=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();


    echo $query->rowCount();
}
else {
    echo "One or more parameters are not passed into subscribe.php the file";
}

?>