<?php


class SearchResultsProvider
{

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj)
    {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy, $category)
    {
        $alpha_order = 'DESC';
        if ($orderBy == "name") {
            $alpha_order = 'ASC';
        }

        if ($category) {
            $query = $this->con->prepare("SELECT * FROM videos WHERE (title LIKE CONCAT('%', :term, '%')
                                        OR uploadedBy LIKE CONCAT('%', :term, '%') ) AND privacy=1 AND category=$category ORDER BY $orderBy $alpha_order");

        } else {
            $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%')
                                        OR uploadedBy LIKE CONCAT('%', :term, '%')  AND privacy=1 ORDER BY $orderBy $alpha_order");
        }

        $query->bindParam(":term", $term);
        $query->execute();

        $videos = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }


        return $videos;

    }


    public function getUsers($term, $orderBy, $type)
    {

        $alpha_order = 'DESC';
        if ($orderBy == "name") {
            $alpha_order = 'ASC';
        }

        if ($orderBy == "name") {
            $alpha_order = 'ASC';
        }

        if ($type) {
            $query = $this->con->prepare("SELECT username FROM users WHERE (firstName LIKE CONCAT('%', :term, '%')
                                        OR lastName LIKE CONCAT('%', :term, '%')
                                        OR username LIKE CONCAT('%', :term, '%'))
                                        ORDER BY username $alpha_order
                                        ");
        } else {
            $query = $this->con->prepare("SELECT username FROM users WHERE (firstName LIKE CONCAT('%', :term, '%')
                                        OR lastName LIKE CONCAT('%', :term, '%')
                                        OR username LIKE CONCAT('%', :term, '%') )
                                        ORDER BY username $alpha_order
                                        ");
        }

        $query->bindParam(":term", $term);
        $query->execute();


        $users = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = ButtonProvider::createUserProfileButtonSearch($this->con, $row['username'] );
            array_push($users, $user);
        }

        return $users;


    }


}
?>