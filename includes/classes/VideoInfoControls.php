<?php
require_once("includes/classes/ButtonProvider.php");

class VideoInfoControls {

    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj) {
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {

        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();
        $favButton = $this->createfavouriteButton();

        $videoId = $this->video->getId();
        //playlistInput To Userd
        $urlAdd ="addToPlaylist.php?id=$videoId";
        $urlCreate ="CreatePlaylist.php?id=$videoId";




        $AddPlaylistInput = ButtonProvider::createHyperlinkButton("ADD To Playlist","", $urlAdd,'');
        $CreatePlaylistnput = ButtonProvider::createHyperlinkButton("Create a Playlist","", $urlCreate,'');

        return "<div class='controls'>
                    $likeButton
                    $dislikeButton
                    $favButton
                    
                    
                    $AddPlaylistInput
                    $CreatePlaylistnput
                    
                </div>";
    }

    private function createLikeButton() {
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";

        $imageSrc = "assets/images/icons/Like.png";

        if($this->video->wasLikedBy()) {
            $imageSrc = "assets/images/icons/Liked.png";
        }

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createDislikeButton() {
        $text = $this->video->getDislikes();
        $videoId = $this->video->getId();
        $action = "dislikeVideo(this, $videoId)";
        $class = "dislikeButton";

        $imageSrc = "assets/images/icons/Dislike.png";

        if($this->video->wasDislikedBy()) {
            $imageSrc = "assets/images/icons/Disliked.png";
        }

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createfavouriteButton() {
        $videoId = $this->video->getId();
        $action = "favourite(this, $videoId)";
        $class = "favouriteButton";

        $imageSrc = "assets/images/icons/unfav.png";

        if($this->video->isFavourite()) {
            $imageSrc = "assets/images/icons/fav.png";
        }

        return ButtonProvider::createButton('', $imageSrc, $action, $class);
    }


}
?>