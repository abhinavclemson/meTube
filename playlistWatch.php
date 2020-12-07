<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/Comment.php");
require_once("includes/classes/CommentSection.php");

if(!isset($_GET["username"]) && !isset($_GET['playlistName'])) {
    echo "No url passed into page";
    exit();
}

$playlistName = $_GET['playlistName'];
$username = $_GET['username'];


$query = $con->prepare("SELECT * from playlists WHERE (username=:username and playlist_name=:playlist_name)");
$query->bindParam(":username",$username);
$query->bindParam(":playlist_name",$playlistName);
$query->execute();

if($query->rowCount()<1){
    echo "No videos in this playlist ";
    exit();
}

$videoId = '';
$count=0;
$videos = array();
$buttons= '';
while($row = $query->fetch(PDO::FETCH_ASSOC)) {

    if($row['videoId']!=0){
        if($count==0){
            $videoId = $row["videoId"];
            $count = $count+1;
        }
        $id = $row["videoId"];
        $video = new Video($con, $id, $userLoggedInObj);

        $text = "Remove ".$video->getTitle();

        $videos[] = $video;
        $buttons.=ButtonProvider::deletePlaylistVideoButton($userLoggedInObj, $videoId, $playlistName, $text);

    }

}

$video = new Video($con, $videoId , $userLoggedInObj);
$video->incrementViews();
?>
<script src="assets/js/commentActions.js"></script>
<script src="assets/js/videoPlayerActions.js"></script>
<script src="assets/js/userActions.js"></script>

<div class="watchLeftColumn">

    <?php
    $videoPlayer = new VideoPlayer($video);
    echo $videoPlayer->create(true);

    $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj);
    echo $videoPlayer->create();

    $commentSection = new CommentSection($con, $video, $userLoggedInObj);
    echo $commentSection->create();
    ?>


</div>

<div class="suggestions">

    <?php
    $videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());

    echo $videoGrid->create($videos, $playlistName, false);

    echo $buttons;
    ?>

</div>




<?php require_once("includes/footer.php"); ?>
