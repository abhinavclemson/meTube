<?php
class ButtonProvider {

    public static $signInFunction = "notSignedIn()";

    public static function createLink($link) {
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }

    public static function createButton($text, $imageSrc, $action, $class) {

        $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        $action  = ButtonProvider::createLink($action);

        return "<button class='$class' onclick='$action'>
                    $image
                    <span class='text'>$text</span>
                </button>";
    }

    public static function createHyperlinkButton($text, $imageSrc, $href, $class) {

        $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        return "<a href='$href'>
                    <button class='$class'>
                        $image
                        <span class='text'>$text</span>
                    </button>
                </a>";
    }

    public static function createUserProfileButton($con, $username) {
        $userObj = new User($con, $username);
        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";

        return "<a href='$link'>
                    <img src='$profilePic' class='profilePicture'>
                </a>";
    }


    public static function createUserProfileButtonSearch($con, $username) {
        $userObj = new User($con, $username);
        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";

        return "<a href='$link'>
                    <img src='$profilePic' class='profilePicture'>
                    $username
                </a>";
    }
    public static function createEditVideoButton($videoId) {
        $href = "editVideo.php?videoId=$videoId";

        $button = ButtonProvider::createHyperlinkButton("EDIT VIDEO", null, $href, "edit button");

        return "<div class='editVideoButtonContainer'>
                    $button
                </div>";
    }

    public static function createSubscriberButton($con, $userToObj, $userLoggedInObj) {
        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();

        $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
        $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userToObj->getSubscriberCount();

        $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='subscribeButtonContainer'>
                    $button
                </div>";
    }

    //block button
    public static function createBlockButton($con, $userToObj, $userLoggedInObj) {

        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();


        $isBlock = $userLoggedInObj->isBlock($userTo);

        $buttonText = $isBlock ? "BLOCKED" : "BLOCK";


        $buttonClass = $isBlock ? "Unblock button" : "block button";
        $action = "block(\"$userTo\", \"$userLoggedIn\", this)";


        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='blockButtonContainer' >
                    $button
                </div>";
    }


    //family button
    public static function createFamilyButton($con, $userToObj, $userLoggedInObj) {

        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();


        $isFamily = $userLoggedInObj->isFamily($userTo);

        $buttonText = $isFamily ? "UNFAMILY" : "FAMILY";


        $buttonClass = $isFamily? "unfamily button" : "family button";
        $action = "family(\"$userTo\", \"$userLoggedIn\", this)";


        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='blockButtonContainer' >
                    $button
                </div>";
    }

    //friends button
    public static function createFriendsButton($con, $userToObj, $userLoggedInObj) {

        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();


        $isFriend = $userLoggedInObj->isFriend($userTo);

        $buttonText = $isFriend? "UNFRIEND" : "FRIEND" ;


        $buttonClass = $isFriend? " unfriend" : "friend button";
        $action = "friend(\"$userTo\", \"$userLoggedIn\", this)";


        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='blockButtonContainer' >
                    $button
                </div>";
    }
    //Delete button
    public static function createDeleteButton($con, $videoId) {

        $isVideo= ButtonProvider::isVideo($con,$videoId);

        $buttonText = $isVideo ? "DELETE" : "DELETED";


        $buttonClass = $isVideo ? "delete button" : "deleted button";
        $action = "deleted( \"$videoId\", this)";


        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='blockButtonContainer' >
                    $button
                </div>";
    }


    public static function createUserProfileNavigationButton($con, $username) {
        if(User::isLoggedIn()) {
            return ButtonProvider::createUserProfileButton($con, $username);
        }
        else {
            return "<a href='signin.php'>
                        <span class='signInLink'>SIGN IN</span>
                    </a>";
        }
    }

    public function isVideo($con,$videoId){
        $query = $con->prepare("SELECT * FROM videos WHERE id=:videoId");
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        return $query->fetchColumn();

    }



}
?>