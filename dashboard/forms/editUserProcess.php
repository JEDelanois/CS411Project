<?php 
require '../../dbconfig.php';
require '../../classes/Database.php';
require '../../libs/password.php';
require '../../classes/User.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

if(isset($_POST)){
	// create an array to store the user information
	$userInfo = [];
	$userInfo["user_id"] = htmlentities($_POST["user_id"]);
	$userInfo["user_firstName"] = htmlentities($_POST["user_firstName"]);
	$userInfo["user_lastName"] = htmlentities($_POST["user_lastName"]);
	$userInfo["user_email"] = htmlentities($_POST["user_email"]);

	$userInfo["user_role"] = htmlentities($_POST["user_role"]);
	$db = new DatabaseConnection();

	if($_POST["user_password"] != ""){
		$password = htmlentities($_POST["user_password"]);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$userInfo["user_password"] = $hashedPassword;
		$db->changeUserData($userInfo, true);
	} else {
		$db->changeUserData($userInfo, false);
	}


	// $db->insertUserIntoTable($userInfo);

	header("Location: ../editUser.php?user_id=" . $userInfo["user_id"]);
}


// 21