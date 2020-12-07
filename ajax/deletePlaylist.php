<?php
require_once("../includes/config.php");

echo $_POST['videoId'];
if($_POST['username'] && $_POST['playlistName']) {

    $videoId = $_POST['videoId'];
    $username = $_POST['username'];
    $playlistName = $_POST['playlistName'];

    // check if the user is subbed
    $query = $con->prepare("DELETE FROM playlists WHERE username=:username and Playlist_name=:playlist_name");
    $query->bindParam(":username", $username);
    $query->bindParam(":playlist_name", $playlistName);

    $query->execute();


}
else {
    echo "One or more parameters pass for removing  the playlist is invalid ";
}

?>