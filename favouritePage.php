<?php
require_once("includes/header.php");
require_once("includes/classes/VideoDetailFormProvider.php");
require_once("includes/classes/VideoGridFavourite.php");



?>

    <div class="videoSection">
        <?php
        $videoGrid = new VideoGridFavourite($con, $userLoggedInObj->getUsername());
        echo $videoGrid->create(null, "Favourites", false);
        ?>

    </div>

<?php require_once("includes/footer.php"); ?>