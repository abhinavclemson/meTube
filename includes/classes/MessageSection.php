<?php
class MessageSection {

    private $con, $profileUsernameObj, $userLoggedInObj;

    //working
    public function __construct($con, $profileUsername, $userLoggedInObj) {
        $this->con = $con;
        $this->profileUsernameObj = new User($con, $profileUsername);
        $this->userLoggedInObj = $userLoggedInObj;

        echo $this->profileUsernameObj->getUsername();
    }

    public function create() {
        return $this->createMessageSection();
    }

    private function createMessageSection() {
        $numMessages = $this->getNumberOfMessages();
        $postedBy = $this->userLoggedInObj->getUsername();
        $profileUsernameId = $this->profileUsernameObj->getUsername();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $MessageAction = "postMessage(this, \"$postedBy\", $profileUsernameId, null, \"Messages\")";
        $MessageButton = ButtonProvider::createButton("Message", null, $MessageAction, "postMessage");

        $Messages = $this->getmessages();
        $messageItems = "";
        foreach($Messages as $message) {
            $messageItems .= $message->create();
        }

        return "<div class='messageSection'>

                    <div class='header'>
                        <span class='messageCount'>$numMessages messages</span>

                        <div class='messageForm'>
                            $profileButton
                            <textarea class='messageBodyClass' placeholder='Add a public message'></textarea>
                            $MessageButton
                        </div>
                    </div>

                    <div class='messages'>
                        $messageItems
                    </div>

                </div>";
    }

    private function getNumberOfMessages(){

            $query = $this->con->prepare("SELECT * FROM messages where messageBy=:messageBy and messageTo=:messageTo");

            $profileUsername = $this->profileUsernameObj->getUsername();
            $username = $this->userLoggedInObj->getUsername();
            $query->bindParam(":messageBy", $profileUsername);
            $query->bindParam(":messageTo", $username);

            $query->execute();

            return  $query->rowCount();



    }
    public function getMessages()
    {

        $query = $this->con->prepare("SELECT * FROM messages where messageBy=:messageBy and messageTo=:messageTo");

        $profileUsername = $this->profileUsernameObj->getUsername();
        $username = $this->userLoggedInObj->getUsername();
        $query->bindParam(":messageBy", $profileUsername);
        $query->bindParam(":messageTo", $username);

        $query->execute();


        $messages = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message($this->con, $row, $this->userLoggedInObj, $this->profileUsernameObj);
            array_push($messages, $message);
        }

        return $messages;

    }

}
?>