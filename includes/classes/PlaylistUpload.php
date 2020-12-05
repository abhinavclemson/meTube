<?php


class PlaylistUpload{
    public $playlistName, $username, $privacy,$videoId;

    public function __construct( $playlistName, $username, $privacy,$videoId){
        $this->playlistName = $playlistName;
        $this->username = $username;
        $this->privacy = $privacy;
        $this->videoId = $videoId;

    }

    public function updateDetails($con, $videoId) {
        $query = $con->prepare("INSERT INTO playlists(Playlist_name, username, privacy, videoId) 
                                VALUES (:playlistName, :username, :privacy, :videoId)");
        $query->bindParam(":playlistName", $this->playlistName);
        $query->bindParam(":username", $this->username);
        $query->bindParam(":privacy", $this->privacy);
        $query->bindParam(":videoId", $this->videoId);

        return $query->execute();
    }
}
?>
