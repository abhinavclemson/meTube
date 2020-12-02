<?php
require_once("VideoGridItemFav.php");

class VideoGridFavourite {

    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter) {

        if($videos == null) {
            $gridItems = $this->generateFavourites();
        }
        else {
            $gridItems = $this->generateItemsFromVideos($videos);
        }

        $header = "";

        if($title != null) {
            $header = $this->createGridHeader($title, $showFilter);
        }

        return "$header
                <div class='$this->gridClass'>
                    $gridItems
                </div>";
    }

    public function generateItems() {
        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementsHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $video = new Video($this->con, $row, $this->userLoggedInObj);
            $item = new VideoGridItemFav($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }
    public function generateFavourites() {
        $username = $this->userLoggedInObj;

        $query = $this->con->prepare("select a.* from videos a inner join favourites b on a.id=b.videoid where b.username=:username;");
        $query->bindParam(":username", $username);
        $query->execute();

        $elementsHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $video = new Video($this->con, $row, $this->userLoggedInObj);
            $item = new VideoGridItemFav($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }
    public function generateItemsFromVideos($videos) {
        $elementsHtml = "";

        foreach($videos as $video) {
            $item = new VideoGridItemFav($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }

    public function createGridHeader($title, $showFilter) {
        $filter = "";

        // create filter

        return "<div class='videoGridHeader'>
                        <div class='left'>
                            $title
                        </div>
                        $filter
                    </div>";
    }

}
?>