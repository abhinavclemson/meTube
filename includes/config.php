<?php
ob_start(); // Turns on output buffering
session_start();//now we can use session variables


//mysql -h mysql1.cs.clemson.edu -u meTube_rlps -p meTube_350t

//mysql -h MySQL_hostname -u username -p database_name
//mysql -h mysql1.cs.clemson.edu -u meTubeDATA_7yt7 -p meTubeDATA_t9se


$dbhost = "mysql1.cs.clemson.edu";
$dbuser = "meTubeDATA_7yt7";
$dbpass = "abhinav@123C";
$dbname = "meTubeDATA_t9se";
try{
    $con =new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e){
    echo "Connection Failed: ". $e->getMessage();
}
?>


