<?php
require_once("includes/header.php");
require_once("includes/classes/SearchResultsProvider.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
    echo "You must enter a search term";
    exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views" ) {
    $orderBy = "views";
}
else {
    $orderBy = "uploadDate";
}

$category='';

if(isset($_GET["category"])){
    $category=$_GET["category"];
}



$searchResultsProvider = new SearchResultsProvider($con, $userLoggedInObj);
$videos = $searchResultsProvider->getVideos($term, $orderBy,$category);



$videoGrid = new VideoGrid($con, $userLoggedInObj);
?>




<div class="largeVideoGridContainer">

    <?php

    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, sizeof($videos) . " results found", true);

    }
    else {
        echo "No results found";
    }

    ?>

    <div class="users">
        <h6>Users Found</h6>
        <?php
        $users = $searchResultsProvider->getUsers($term, $orderBy,$category);
        $count=0;

        foreach($users as $user) {
            echo $user;
            }


        ?>

    </div>

</div>










