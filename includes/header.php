<?php
require_once("includes/config.php");
require_once("includes/classes/User.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/Comment.php");
require_once("includes/classes/CommentSection.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/VideoGridFavourite.php");
require_once("includes/classes/SubscriptionsProvider.php");
require_once("includes/classes/NavigationMenuProvider.php");
require_once("includes/classes/LikedVideosProvider.php");

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);


?>
<!DOCTYPE html>
<html>
<head>
    <title>MeTube</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="assets/js/blockActions.js" type='text/javascript'></script>
    <script src="assets/js/commonActions.js" type='text/javascript'></script>
    <script src="assets/js/userActions.js" type='text/javascript'></script>
    <script src="assets/js/messageActions.js" type='text/javascript'></script>


</head>
<body>

<div id="pageContainer">

    <div id="mastHeadContainer">
        <button class="navShowHide">
            <img src="https://img.icons8.com/doodle/48/000000/menu.png"/>
        </button>

        <a class="logoContainer" href="index.php">

            <img src="https://img.icons8.com/material-two-tone/48/000000/video.png" title="me
    tube" alt="meTube"/>
        </a>

        <div class="searchBarContainer">

            <form action="search.php" method="GET">
                <input type="text" class="searchBar" name="term" placeholder="Search...">
                <button class="searchButton">
                    <img src="https://img.icons8.com/material-two-tone/24/000000/search-database.png" title="Search button" alt="Search"/>
                </button>
            </form>

        </div>





        <div class="rightIcons">
            <a href="playlists.php">
                <img src="https://img.icons8.com/material-two-tone/24/000000/video-playlist.png"/>
            </a>
            <a href="favouritePage.php">
                <img src="assets/images/icons/star.png"/>
            </a>
            <a href="upload.php">
                <img src="https://img.icons8.com/material-two-tone/48/000000/circled-up.png"/>
            </a>


            <?php
            //if user is logged in it would return html code with link to user's profile picture
            echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername());
            ?>

        </div>

    </div>

    <div id="sideNavContainer" style="display:none;">
        <?php
        $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);
        echo $navigationProvider->create();
        ?>

    </div>

    <div id="mainSectionContainer">

        <div id="mainContentContainer">