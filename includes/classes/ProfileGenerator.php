<?php
require_once("ProfileData.php");
require_once("MessageSection.php");
class ProfileGenerator {

    private $con, $userLoggedInObj, $profileData;

    public function __construct($con, $userLoggedInObj, $profileUsername) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($con, $profileUsername);
    }

    public function create() {
        $profileUsername = $this->profileData->getProfileUsername();

        if(!$this->profileData->userExists()) {
            return "User does not exist";
        }

        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();


        return "<div class='profileContainer'>
                    $headerSection
                    $tabsSection
                    $contentSection
                    
                </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc = $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();
        return "<div class='coverPhotoContainer'>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                    <span class='channelName'>$name</span>
                </div>";
    }

    public function createHeaderSection() {
        $profileImage = $this->profileData->getProfilePic();
        $name = $this->profileData->getProfileUserFullName();
        $subCount = $this->profileData->getSubscriberCount();

        $button = $this->createHeaderButton();
        $block = $this->createBlockButton();
        $friend = $this->createFriendButton();
        $family = $this->createFamilyButton();



        return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img class='profileImage' src='$profileImage'>
                        <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                        <div class='buttonItem'>    
                            
                            $block
                            $friend
                            $family
                            $button
                        </div>
                    </div>
                </div>";
    }

    public function createTabsSection() {
        $family='';
        $friend='';
        $blocked='';
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            $family ="<li class='nav-item'><a class='nav-link' id='family-tab' data-toggle='tab' href='#family' role='tab' 
                        aria-controls='family' aria-selected='false'>Family</a>
                    </li>";

            $friend ="<li class='nav-item'><a class='nav-link' id='friends-tab' data-toggle='tab' href='#friends' role='tab' 
                        aria-controls='about' aria-selected='false'>Friends</a>
                    </li>";

            $blocked="<li class='nav-item'>
                    <a class='nav-link' id='blocked-tab' data-toggle='tab' href='#blocked' role='tab' 
                        aria-controls='about' aria-selected='false'>Blocked</a>
                    </li>";

        }

        $footer="<ul class='nav nav-tabs' role='tablist'>
                    <li class='nav-item'>
                    <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                        href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                    </li>
                    

                    
                    <li class='nav-item'>
                    <a class='nav-link' id='messages-tab' data-toggle='tab' href='#messages' role='tab' 
                        aria-controls='messages' aria-selected='false'>MESSAGES</a>
                    </li>";

        $footer.=$family.$friend.$blocked;

        $footer.="<a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' 
                        aria-controls='about' aria-selected='false'>ABOUT</a>
                    </li>
                </ul>";

        return $footer;
    }

    public function createContentSection() {


        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            $msgSection = '';
        }
        else{
            $messageSection = new MessageSection($this->con, $this->profileData->getProfileUsername(), $this->userLoggedInObj);
            $msgSection = $messageSection->create();
        }

        $videos = $this->profileData->getUsersVideos();

        if(sizeof($videos) > 0) {
            $videoGrid = new VideoGrid($this->con, $this->userLoggedInObj);
            $videoGridHtml = $videoGrid->create($videos, null, false);
        }
        else {
            $videoGridHtml = "<span>This user has no videos</span>";
        }

        $aboutSection = $this->createAboutSection();




        $families = $this->userLoggedInObj->getFamily();
        $familyItems = "";

        foreach($families as $family) {
            $familyItems .= $family;
        }

        $friends = $this->userLoggedInObj->getFriends();
        $friendsItems = "";

        foreach($friends as $friend) {
            $friendsItems .= $friend;
        }

        $blocked = $this->userLoggedInObj->getBlocked();
        $blockedItems = "";

        foreach($blocked as $block) {
            $blockedItems .= $block;
        }


        return "<div class='tab-content channelContent'>

                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                        $aboutSection
                        
                    </div>
                    
                    <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                        $videoGridHtml
                    </div>

                    
                    <div class='tab-pane fade' id='messages' role='tabpanel' aria-labelledby='messages-tab'>
                       $msgSection
                       
                    </div>
                    
                     <div class='tab-pane fade' id='friends' role='tabpanel' aria-labelledby='friends-tab'>
                                                   $friendsItems

                    </div>
                    
                     <div class='tab-pane fade' id='family' role='tabpanel' aria-labelledby='family-tab'>
                              $familyItems
                              
                    </div>
                     <div class='tab-pane fade' id='blocked' role='tabpanel' aria-labelledby='block-tab'>
                              $blockedItems
                              
                    </div>
                </div>";
    }

    private function createHeaderButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createSubscriberButton(
                $this->con,
                $this->profileData->getProfileUserObj(),
                $this->userLoggedInObj);

        }
    }


    //block button 1
    private function createBlockButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createBlockButton(
                $this->con,
                $this->profileData->getProfileUserObj(),
                $this->userLoggedInObj);
        }
    }

    //friends button 1
    private function createFriendButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createFriendsButton(
                $this->con,
                $this->profileData->getProfileUserObj(),
                $this->userLoggedInObj);
        }
    }

    //family button
    private function createFamilyButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createFamilyButton(
                $this->con,
                $this->profileData->getProfileUserObj(),
                $this->userLoggedInObj);
        }
    }



    private function createAboutSection() {
        $html = "<div class='section'>
                    <div class='title'>
                        <span>Details</span>
                    </div>
                    <div class='values'>";

        $details = $this->profileData->getAllUserDetails();
        foreach($details as $key => $value) {
            $html .= "<span>$key: $value</span>";
        }

        $html .= "</div></div>";

        return $html;
    }

    private function createMessageSection() {

        $html = "<div class='section'>
                    <div class='title'>
                        <span>Details</span>
                    </div>
                    <div class='values'>";

        $profileUsername = $this->profileData->getProfileUsername();

        $userLoggedInObj = $this->userLoggedInObj;
        echo $messageSection->create();

        $messageSection = new MessageSection($con, $profileUsername, $userLoggedInObj);
            $html .= "<span>$messageSection->create(); </span>";


        $html .= "</div></div>";

        return $html;
    }

}
?>