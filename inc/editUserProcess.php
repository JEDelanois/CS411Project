<?php 
require '../user_session.php';
require '../dbconfig.php';
require '../classes/Database.php';
if(isset($_POST)){
	if(isset($_POST['firstNameTextField']))
		$currentUser["user_firstname"] = htmlentities($_POST['firstNameTextField']);
	if(isset($_POST['lastNameTextField']))
		$currentUser['user_lastname'] = htmlentities($_POST['lastNameTextField']);
	if(isset($_POST['emailTextField']))
		$currentUser['user_email'] = htmlentities($_POST['emailTextField']);
	if(isset($_POST['userRoleSelection']))
		$currentUser['user_role'] = htmlentities($_POST['userRoleSelection']);
    if(isset($_POST['dobTextField']))
    	$currentUser['user_dob'] = htmlentities($_POST['dobTextField']);
    if(isset($_POST['weightTextField']))
    	$currentUser['user_weight'] = htmlentities($_POST['weightTextField']);
    if(isset($_POST['targetWeightTextField']))
    	$currentUser['user_targetweight'] = htmlentities($_POST['targetWeightTextField']);
    if(isset($_POST['heightTextField']))
    	$currentUser['user_height'] = htmlentities($_POST['heightTextField']);
    if(isset($_POST['genderSelection']))
    	$currentUser['user_gender'] = htmlentities($_POST['genderSelection']);
     $db = new DatabaseConnection();
	if(isset($_POST['passwordTextField'])){
		$userInfo = $currentUser;
		$userInfo["user_password"] = $_POST['passwordTextField'];
		$db->changeUserData($userInfo, true);
	} else {
		$db->changeUserData($currentUser, false);
	}
}

header('Location: ' . strtok($_SERVER['HTTP_REFERER'], "?"));