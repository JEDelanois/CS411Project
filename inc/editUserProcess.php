<?php 
require '../user_session.php';
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
// print_r($currentUser);
if(isset($_POST)){
	if(isset($_POST['firstNameTextField']) && $_POST['firstNameTextField'])
		$currentUser["user_firstname"] = htmlentities($_POST['firstNameTextField']);
	if(isset($_POST['lastNameTextField']) && $_POST['lastNameTextField'])
		$currentUser['user_lastname'] = htmlentities($_POST['lastNameTextField']);
	if(isset($_POST['emailTextField']) && $_POST['emailTextField'])
		$currentUser['user_email'] = htmlentities($_POST['emailTextField']);
	if(isset($_POST['userRoleSelection']) && $_POST['userRoleSelection'])
		$currentUser['user_role'] = htmlentities($_POST['userRoleSelection']);
    if(isset($_POST['dobTextField']) && $_POST['dobTextField'])
    	$currentUser['user_dob'] = htmlentities($_POST['dobTextField']);
    if(isset($_POST['weightTextField']) && $_POST['weightTextField'])
    	$currentUser['user_weight'] = htmlentities($_POST['weightTextField']);
    if(isset($_POST['targetWeightTextField']) && $_POST['targetWeightTextField']){
    	$currentUser['user_targetweight'] = htmlentities($_POST['targetWeightTextField']);
    }
    if($_POST['heightTextFieldFT'] || $_POST["heightTextFieldIN"]){
    	$height = 0;
    	if($_POST["heightTextFieldFT"])
    		$height += floatval(htmlentities($_POST["heightTextFieldFT"])) * 12;
    	if($_POST["heightTextFieldIN"])
    		$height += floatval(htmlentities($_POST["heightTextFieldIN"]));
    	$currentUser['user_height'] = $height;
    }
    if(isset($_POST['genderSelection']) && $_POST['genderSelection'] != "select")
    	$currentUser['user_gender'] = htmlentities($_POST['genderSelection']);
     $db = new DatabaseConnection();
	if(isset($_POST['passwordTextField']) && $_POST['passwordTextField']){
		$userInfo = $currentUser;
		$userInfo["user_password"] = password_hash(htmlentities($_POST['passwordTextField']), PASSWORD_DEFAULT);
		$db->changeUserData($userInfo, true);
	} else {
		$db->changeUserData($currentUser, false);
		// die();
	}
}

header('Location: ' . strtok($_SERVER['HTTP_REFERER'], "?"));