<?php
require '../classes/Database.php';
if(isset($_POST)){
	// create an array to store the user information
	$userInfo = [];
	$userInfo["user_firstName"] = $_POST["user_firstName"];
	$userInfo["user_lastName"] = $_POST["user_lastName"];
	$userInfo["user_email"] = $_POST["user_email"];
	$userInfo["user_password"] = $_POST["user_password"];
	$userInfo["user_role"] = "user";

	$db = new DatabaseConnection();

	$db.insertUserIntoTable($userInfo);

}