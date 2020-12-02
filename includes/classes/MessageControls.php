<?php
require_once("ButtonProvider.php");
class MessageControls
{

    private $con, $message, $userLoggedInObj;

    public function __construct($con, $message, $userLoggedInObj)
    {
        $this->con = $con;
        $this->message = $message;
        $this->userLoggedInObj = $userLoggedInObj;
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
        $profileUsername = $this->message->getProfileUsername();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $messageBy);

        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = ButtonProvider::createButton("Cancel", null, $cancelButtonAction, "cancelMessage");

        $postButtonAction = "postMessage(this, \"$messageBy\",  $messageTo, \"repliesSection\")";
        $postButton = ButtonProvider::createButton("Reply", null, $postButtonAction, "postMessage");

        return "<div class='messageForm hidden'>
                    $profileButton
                    <textarea class='messageBodyClass' placeholder='Add a public message'></textarea>
                    $cancelButton
                    $postButton
                </div>";
    }
}



?>