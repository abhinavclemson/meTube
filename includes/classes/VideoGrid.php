<?php
require_once("VideoGridItem.php");

class VideoGrid {

    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter) {

        if($videos == null) {
            $gridItems = $this->generateItems();
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
            $item = new VideoGridItem($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }

    public function generateItemsFromVideos($videos) {
        $elementsHtml = "";

        foreach($videos as $video) {
            $item = new VideoGridItem($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }

    public function createGridHeader($title, $showFilter) {
        $filter = "";

        if($showFilter) {
            $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $urlArray = parse_url($link);
            $query = $urlArray["query"];

            parse_str($query, $params);

            unset($params["orderBy"]);
            unset($params["category"]);

            $newQuery = http_build_query($params);

            $newUrl = basename($_SERVER["PHP_SELF"]) . "?" . $newQuery;

            $filter = "<form id='catForm'>
                            <span>Order by:</span>
                            <a href='$newUrl&orderBy=uploadDate'>Upload date</a>
                            <a href='$newUrl&orderBy=views'>Most viewed</a>
                            <a href='$newUrl&orderBy=name'>Alphabetical order</a>
                            <a href='$newUrl&orderBy=duration'>Duration size</a>
                            <form action='$newUrl'>

                            <select onchange='document.location = this.value'>
                                                <option value=''>Categories</option> 
                                               <option value='$newUrl&category=1'>Film & Animation</option>
                                               <option value='$newUrl&category=2'>Autos & Vehicles </option>
                                               <option value='$newUrl&category=3'>Music</option>
                                               <option value='$newUrl&category=4'>Pets & Animals</option>    
                                               <option value='$newUrl&category=5'>Sports</option>
                                               <option value='$newUrl&category=6'>Travel & Events</option>
                                               <option value='$newUrl&category=7'>Gaming</option>
                                               <option value='$newUrl&category=8'>People & Blogs</option> 
                                               <option value='$newUrl&category=9'>Comedy </option>
                                               <option value='$newUrl&category=10'>Entertainment</option>
                                               <option value='$newUrl&category=11'>News & Politics</option>    
                                               <option value='$newUrl&category=12'>How to & Style</option>
                                               <option value='$newUrl&category=13'>Education</option>
                                               <option value='$newUrl&category=14'>Science & Technology</option>
                                               <option value='$newUrl&category=15'>Non Profits & Activism</option>                   
                                </select>


                             </form>";
        }

        return "<div class='videoGridHeader'>
                        <div class='left'>
                            $title
                        </div>
                        $filter
                    </div>";
    }

    public function createLarge($videos, $title, $showFilter) {
        $this->gridClass .= " large";
        $this->largeMode = true;
        return $this->create($videos, $title, $showFilter);
    }

}
?>