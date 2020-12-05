<?php
require_once("Message.php");
class User {

    private $con, $sqlData;

    public function __construct($con, $username) {
        $this->con = $con;

        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
    }

    public function getUsername() {
        return User::isLoggedIn() ? $this->sqlData["username"] : "";
    }


    public function getName() {
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getFirstName() {
        return $this->sqlData["firstName"];
    }

    public function getLastName() {
        return $this->sqlData["lastName"];
    }

    public function getEmail() {
        return $this->sqlData["email"];
    }

    public function getProfilePic() {
        return $this->sqlData["profilePic"]??'';
    }

    public function getSignUpDate() {
        return $this->sqlData["signUpDate"];
    }

    public function isSubscribedTo($userTo) {
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount() > 0;
    }

    //block came form Buttonprovider.php
    public function isBlock($userTo) {
        $query = $this->con->prepare("SELECT * FROM block WHERE blockedBy=:blockedBy AND blockedTo=:blockedTo");
        $query->bindParam(":blockedTo", $userTo);
        $query->bindParam(":blockedBy", $username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount() > 0;
    }
    public function getSubscriberCount() {
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $query->bindParam(":userTo", $username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount();
    }

    public function isFamily($userTo) {
        $query = $this->con->prepare("SELECT * FROM family WHERE (username=:username AND fname=:fname) or (username=:fname AND fname=:username)");
        $query->bindParam(":fname", $userTo);
        $query->bindParam(":username", $username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function isFriend($userTo) {
        $query = $this->con->prepare("SELECT * FROM friend WHERE (username=:username AND fname=:fname) or (username=:fname AND fname=:username)");
        $query->bindParam(":username", $username);
        $query->bindParam(":fname", $userTo);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function getSubscriptions() {
        $query = $this->con->prepare("SELECT userTo FROM subscribers WHERE userFrom=:userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);
        $query->execute();

        $subs = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->con, $row["userTo"]);
            array_push($subs, $user);
        }
        return $subs;


    }
    public function getNumberOfReplies($userTo) {
        $query = $this->con->prepare("SELECT * FROM messages WHERE messageBy=:messageBy and messageTo=:messageTo");
        $username = $this->getUsername();
        $query->bindParam(":messageBy", $username);
        $query->bindParam(":messageTo", $userTo);

        $query->execute();

        $subs = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->con, $row["messageTo"]);
            array_push($subs, $user);
        }
        return $subs;


    }
    public function getMessages($userTo) {
        $query = $this->con->prepare("SELECT * FROM messages WHERE (messageBy=:messageBy and messageTo=:messageTo) or ( messageBy=:messageTo and messageTo=:messageBy)");
        $username = $this->getUsername();

        $query->bindParam(":messageBy", $username);
        $query->bindParam(":messageTo", $userTo);

        $query->execute();



        $userObjTo = new User($this->con, $userTo);
        $userObjFrom = new User($this->con, $username);
        $messages = array();


        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message($this->con, $row, $userObjFrom, $userObjTo);
            array_push($messages, $message);
        }

        return $messages;

    }


    public function getFamily() {
        $query = $this->con->prepare("SELECT fname FROM family WHERE username=:username");
        $username = $this->getUsername();

        $query->bindParam(":username", $username);

        $query->execute();



        $families = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = ButtonProvider::createUserProfileButtonSearch($this->con, $row['fname'] );
            array_push($families, $user);
        }


        return $families;

    }

    public function getFriends() {
        $query = $this->con->prepare("SELECT fname FROM friend WHERE username=:username");
        $username = $this->getUsername();

        $query->bindParam(":username", $username);

        $query->execute();



        $friends = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = ButtonProvider::createUserProfileButtonSearch($this->con, $row['fname'] );
            array_push($friends, $user);
        }


        return $friends;

    }

    public function getBlocked() {
        $query = $this->con->prepare("SELECT blockedTo FROM block WHERE blockedBy=:username");
        $username = $this->getUsername();

        $query->bindParam(":username", $username);

        $query->execute();



        $friends = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = ButtonProvider::createUserProfileButtonSearch($this->con, $row['blockedTo'] );
            array_push($friends, $user);
        }


        return $friends;

    }



    //relation type
    public function getRelation($userTo) {
        $username = $this->getUsername();



        //if user is visiting the same profile
        if($username==$userTo){
            return 0;
        }


        $query = $this->con->prepare("SELECT * FROM friend WHERE (username=:messageBy and fname=:messageTo) or ( username=:messageTo and fname=:messageBy)");
        $query->bindParam(":messageBy", $username);
        $query->bindParam(":messageTo", $userTo);
        $query->execute();

        if($query->rowCount()>0){
            return 2;
        }


        $query = $this->con->prepare("SELECT * FROM family WHERE (username=:messageBy and fname=:messageTo) or ( username=:messageTo and fname=:messageBy)");
        $query->bindParam(":messageBy", $username);
        $query->bindParam(":messageTo", $userTo);
        $query->execute();

        if($query->rowCount()>0){
            return 3;
        }

        return 1;





        $privacy_count = $query->rowCount()>0? 3 : 1;

        return $privacy_count;


    }


}
?>