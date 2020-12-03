<?php

class MessageSection
{

    private $con, $profileUsernameObj, $userLoggedInObj;

    //working
    public function __construct($con, $profileUsername, $userLoggedInObj)
    {
        $this->con = $con;
        $this->profileUsernameObj = new User($con, $profileUsername);
        $this->userLoggedInObj = $userLoggedInObj;

    }

    public function create()
    {
        return $this->createMessageSection();
    }

    private function createMessageSection()
    {
        $MessageBy = $this->userLoggedInObj->getUsername();
        $MessageTo = $this->profileUsernameObj->getUsername();
        $numMessages = $this->userLoggedInObj->getNumberOfReplies($MessageTo);


        $profileButton = ButtonProvider::createUserProfileButton($this->con, $MessageBy);


        //javascript function Ajax Message Action


        $MessageAction = "postMessage(this, \"$MessageBy\", \"$MessageTo\", null, \"messages\")";


        $MessageButton = ButtonProvider::createButton("Message", null, $MessageAction, "postMessage");


        //Get commment HTMl
        $Messages = $this->userLoggedInObj->getMessages($this->profileUsernameObj->getUsername());
        $messageItems = "";

        foreach($Messages as $message) {
            $messageItems .= $message->create();
        }

        return "<div class='messageSection'>

                    <div class='header'>
                        <span class='messageCount'> messages From $MessageTo</span>

                        <div class='messageForm'>
                            $profileButton
                            <textarea class='messageBodyClass' placeholder='Add a private message'></textarea>
                            $MessageButton
                        </div>
                    </div>

                    <div class='messages'>
                        $messageItems
                    </div>

                </div>";
    }






}

    ?>
