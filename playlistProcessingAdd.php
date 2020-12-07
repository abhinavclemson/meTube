<?php
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["saveButton"])) {
    echo "No file sent to page.";
    exit();
}

// 1) create playlist data

$playlistName = $_POST["playlistInput"];
$privacyInput = $_POST["privacyInput"];
$username = $userLoggedInObj->getUsername();



echo $playlistName;
echo $privacyInput;
$videoId= $_POST['videoId'];
$isPlaylist= $userLoggedInObj->isPlaylist($playlistName);

// 2) Process video data (upload)


if($privacyInput && $privacyInput && $videoId){



    $query = $con->prepare("INSERT INTO playlists(playlist_name, username, privacy ,videoId )
                                    VALUES(:playlistName, :username,:privacy, :videoId)");

    $query->bindParam(':playlistName',$playlistName );
    $query->bindParam(':privacy', $privacyInput);
    $query->bindParam(':username', $username);
    $query->bindParam(':videoId', $videoId);

    $query->execute();


}
else{

    echo "Input data is invalid!";
}
// 3) Check if upload was successful





?>