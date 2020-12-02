<?php
ob_start(); // Turns on output buffering
session_start();//now we can use session variables


try{
    $con =new PDO("mysql:dbname=meTube;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e){
    echo "Connection Failed: ". $e->getMessage();
}
?>