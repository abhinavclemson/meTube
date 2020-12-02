<?php


class SearchResultsProvider {

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy, $category) {
        $alpha_order= 'DESC';
        if($orderBy=="name"){
            $alpha_order = 'ASC';
            }

        if($category){
            $query = $this->con->prepare("SELECT * FROM videos WHERE (title LIKE CONCAT('%', :term, '%')
                                        OR uploadedBy LIKE CONCAT('%', :term, '%') ) AND category=$category ORDER BY $orderBy $alpha_order");

        }
        else {
            $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%')
                                        OR uploadedBy LIKE CONCAT('%', :term, '%') ORDER BY $orderBy $alpha_order");
        }

        $query->bindParam(":term", $term);
        $query->execute();

        $videos = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;

    }

}
?>