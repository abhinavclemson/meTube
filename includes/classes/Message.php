<?php
require_once("ButtonProvider.php");
require_once("MessageControls.php");
class Message {

    private $con, $sqlData , $userLoggedInObj, $profileUsernameObj;

    public function __construct($con,$input, $userLoggedInObj, $profileUsernameObj ) {


            if(!is_array($input)) {

                $query = $con->prepare("SELECT * FROM messages where (messageBy=:messageBy and messageTo=:messageTo) OR (messageBy=:messageBy and messageTo=:messageTo)");

                $profileUsername = $profileUsernameObj->getUsername();
                $username = $userLoggedInObj->getUsername();


                $query->bindParam(":messageBy", $username);
                $query->bindParam(":messageTo", $profileUsername);

                $query->execute();
                $input = $query->fetch(PDO::FETCH_ASSOC);

            }
                $this->sqlData = $input;
                $this->con = $con;
                $this->userLoggedInObj = $userLoggedInObj;
                $this->profileUsernameObj = $profileUsernameObj;


    }

    public function create() {
        $id = $this->sqlData["id"];

        $body = $this->sqlData["body"];

        $messageBy = $this->sqlData["messageBy"];
        $messageTo = $this->sqlData["messageTo"];

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $messageBy);
        $profileButton2 = ButtonProvider::createUserProfileButton($this->con, $messageTo);

        $timespan = $this->time_elapsed_string($this->sqlData["datePosted"]);



        $numResponses = $this->getNumberOfReplies();

        if($numResponses > 0) {
            $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getMessages( this, $messageBy, $messageTo)'>
                                    View all $numResponses replies</span>";
        }
        else {
            $viewRepliesText = "<div class='repliesSection'></div>";
        }

        return "<div class='itemContainer'>
                    <div class='message'>
                        $profileButton

                        <div class='mainContainer'>

                            <div class='messageHeader'>
                                <a href='profile.php?username=$messageBy>
                                    <span class='username'>$messageBy</span>
                                </a>
                                <span class='timestamp'>$timespan</span>
                            </div>

                            <div class='body'>
                                $body
                            </div>
                        </div>

                    </div>

                </div>";


    }




    public function getNumberOfReplies() {
        $query = $this->con->prepare("SELECT * FROM messages where (messageBy=:messageBy and messageTo=:messageTo) or (messageTo=:messageBy and messageBy=:messageTo) ORDER BY id ASC");

        $profileUsername = $this->profileUsernameObj->getUsername();
        $username = $this->userLoggedInObj->getUsername();

        $query->bindParam(":messageTo", $profileUsername);
        $query->bindParam(":messageBy", $username);

        $query->execute();

        return $query->fetchColumn();
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }





    public function getReplies()
    {
        $query = $con->prepare("SELECT * FROM messages where (messageBy= :messageBy and messageTo= :messageTo) and (messageBy= :messageTo and messageTo= :messageBy) ");

        $profileUsername = $this->profileUsernameObj->getUsername();
        $username = $this->userLoggedInObj->getUsername();

        $query->bindParam(":messageBy", $username);
        $query->bindParam(":messageTo", $profileUsername);

        $query->execute();

        $messages = array();


        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message($this->con, $row, $this->userLoggedInObj, $this->profileUsernameObj);
            array_push($messages, $message);
        }
        return $messages;
    }


    public function getProfileUsername(){
        return $this->profileUsernameObj->getUsername();
    }

}
?>