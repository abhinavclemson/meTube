<?php
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["saveButton"])) {
    echo "No file sent to page.";
    exit();
}

// 1) create playlist data

$playlistName = $_POST["playlistNameInput"];
$privacyInput = $_POST["privacyInput"];
$username = $userLoggedInObj->getUsername();

echo "$playlistName";

$isPlaylist= $userLoggedInObj->isPlaylist($playlistName);

// 2) Process video data (upload)

// 3) Check if upload was successful


echo $isPlaylist;
echo $username;

if($isPlaylist) {
    echo "Playlist Already exists!";
    exit();
}

else {
    $userLoggedInObj->makePlaylist($playlistName,$privacyInput, $username);
    echo "$playlistName Playlist created!";
}

?>