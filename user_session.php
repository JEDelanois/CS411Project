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