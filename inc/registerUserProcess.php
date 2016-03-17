<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
if(isset($_POST)){
	// create an array to store the user information
	$userInfo = [];
	$userInfo["user_firstName"] = htmlentities($_POST["user_firstName"]);
	$userInfo["user_lastName"] = htmlentities($_POST["user_lastName"]);
	$userInfo["user_email"] = htmlentities($_POST["user_email"]);
	$password = htmlentities($_POST["user_password"]);
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	$userInfo["user_password"] = $hashedPassword;
	$userInfo["user_role"] = "user";

	$db = new DatabaseConnection();

	$db->insertUserIntoTable($userInfo);

	header("Location: ../register.php");
}
