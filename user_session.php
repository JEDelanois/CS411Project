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

function is_logged_in(){
    return isset($currentUser);
}

function is_admin(){
    if(!is_logged_in())
        return false;
    return $currentUser["user_role"] == "administrator";
}
