<?php
require_once("includes/header.php");
require_once("includes/classes/VideoDetailFormProvider.php");
require_once("includes/classes/VideoGridFavourite.php");


echo $playlistName;
?>

    <div class="videoSection">
        <?php
        $urlCreate ="CreatePlaylist.php?id=$videoId";


        $AddPlaylistInput = $userLoggedInObj->getCurrentUserPlaylistGrid();


        echo $AddPlaylistInput;
        ?>

    </div>



<?php
$username = $userLoggedInObj->getUsername();

$username =$_GET['username'];
$playlistName = $_GET['playlistName'];
$query  = $con->prepare("SELECT videoId From playlists WHERE (username=:username and playlist_name=:playlist_name)");
$query->bindParam(':username', $username );
$query->bindParam(':playlist_name', $playlistName);
$query->execute();

$html = '';
$videos=array();
$deletebuttons = "";

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id = $row["videoId"];
    $videos[] = new Video($con,$id, $userLoggedInObj);
    $deletebuttons.= ButtonProvider::deletePlaylistButton($userLoggedInObj, $id, $playlistName);
    echo $deletebuttons;

}

//$videoGrid = new VideoGrid($con,$userLoggedInObj);

//echo $videoGrid->create($videos,$playlistName,'');
echo $deletebuttons;
?>

<?php require_once("includes/footer.php"); ?>