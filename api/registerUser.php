<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

if(isset($_GET["email"]) && isset($_GET["password"]) &&
    isset($_GET["firstname"]) && isset($_GET["lastname"])){
    $userEmail = htmlentities($_GET["email"]);
    if(!$db->checkEmailExist($userEmail)){
        $userInfo = [];
        $userInfo["user_firstname"] = htmlentities($_GET["firstname"]);
        $userInfo["user_lastname"] = htmlentities($_GET["lastname"]);
        $userInfo["user_email"] = $userEmail;
        $userPassword = htmlentities($_GET["password"]);
        $userInfo["user_password"] = password_hash($userPassword, PASSWORD_DEFAULT);
        $userInfo["user_role"] = "user";
        $db->insertUserIntoTable($userInfo);
        $registeredUser = $db->getUserFromEmail($userEmail);
        $jsonArray["num_results"] = count($registeredUser);
        $jsonArray["results"] = $registeredUser;
        echo json_encode($jsonArray);
    } else {
        $userObj = [];
        $userObj["num_results"] = 0;
        $userObj["results"] = NULL;
        $errors = ["email_error" => "Email address already exists"];
        $userObj["errors"] = $errors;
        echo json_encode($userObj);
    }
} else {
    $userObj = [];
    $userObj["num_results"] = 0;
    $userObj["results"] = NULL;
    $errors = [];
    if(!isset($_GET["email"]))
        $errors["email_error"] = "Email Address is required";
    if(!isset($_GET["password"]))
        $errors["password_error"] = "Password is required";
    if(!isset($_GET["firstname"]))
        $errors["firstname_error"] = "Firstname is required";
    if(!isset($_GET["lastname_error"]))
        $errors["lastname_error"] = "Lastname is required";
    $userObj["errors"] = $errors;
    echo json_encode($userObj);
}
