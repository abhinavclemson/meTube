<?php


class Constants
{
    //for signup
    public static $firstNameCharacters = "Your first name must be between 2 and 25";
    public static $lastNameCharacters = "Your Last name must be between 2 and 25";
    public static $UsernameCharacters = "Your username must be between 5 and 25";
    public static $UsernameTaken = "This username already exists!";
    public static $EmailsDoNotMatch = "Your emails do not match!";
    public static $EmailsInvalid = "Please enter valid email!";
    public static $EmailTaken = "This email is already in use!";
    public static $PasswordsDoNotMatch = "Your passwords do not match!";
    public static $PasswordNotAlphanumeric = "Your password can only contain letters and numbers.";
    public static $PasswordLength = "Your password must be between 5 and 30 characters";


    //for login
    public static $LoginFailed= "Your password was incorrect!";


}