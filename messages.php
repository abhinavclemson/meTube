<?php
require_once("includes/header.php");
if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}


