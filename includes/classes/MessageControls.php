<?php
require_once("ButtonProvider.php");
class MessageControls
{

    private $con, $message, $userLoggedInObj, $ProfileUsernameObj;

    public function __construct($con, $message, $userLoggedInObj, $ProfileUsernameObj)
    {
        $this->con = $con;
        $this->message = $message;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->ProfileUsernameObj = $ProfileUsernameObj;
    }

    public function create()
    {

        $replyButton = $this->createReplyButton();
        $replySection = $this->createReplySection();

        return "<div class='controls'>
                    $replyButton
                </div>
                $replySection";
    }

    private function createReplyButton()
    {
        $text = "REPLY";
        $action = "toggleReply(this)";

        return ButtonProvider::createButton($text, null, $action, null);
    }


    private function createReplySection()
    {
        $messageBy = $this->userLoggedInObj->getUsername();
        $messageTo = $this->ProfileUsernameObj ->getUsername();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $messageBy);

        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = ButtonProvider::createButton("Cancel", null, $cancelButtonAction, "cancelMessage");

        $postButtonAction = "postMessage(this, \"$messageBy\",  \"$messageTo\", \"repliesSection\")";

        return "<div class='messageForm hidden'>
                    <textarea class='messageBodyClass' placeholder='Add a public message'></textarea>
                    $cancelButton
                    $postButton
                </div>";
    }
}



?>