<?php 
require '../user_session.php';
require "../classes/Database.php";
require '../libs/password.php';
$user_email = htmlentities($_POST["loginFormEmailTextField"]);
$password = htmlentities($_POST["loginFormPasswordTextField"]);

$db = new DatabaseConnection();
$exist = $db->checkEmailPasswordCombination($user_email, $password);

if($exist){
	$user = $db->getUserFromEmail($user_email);
	setCurrentUser($user);
	header("Location: ../index.php");
} else 
	header("Location: ../login.php");
