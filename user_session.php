<?php
require "classes/User.php";
session_start();

if(isset($_SESSION["currentUser"]))
    $currentUser = $_SESSION["currentUser"];
else
    $currentUser = NULL;

function setCurrentUser($user){
	$_SESSION["currentUser"] = $user;
	$currentUser = $user;
}

function is_logged_in($_currentUser = NULL){
    if($_currentUser == NULL && isset($_SESSION["currentUser"]))
        $_currentUser = $_SESSION["currentUser"];
    return isset($_currentUser) && $_currentUser;
}

function is_admin($_currentUser = NULL){
    if($_currentUser == NULL)
        $_currentUser = $_SESSION["currentUser"];
    if(!is_logged_in($_currentUser))
        return false;
    return $_currentUser["user_role"] == "administrator";
}
