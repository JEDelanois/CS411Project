<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

if(isset($_GET["email"]) && isset($_GET["password"])){
    $email = htmlentities($_GET["email"]);
    $password = htmlentities($_GET["password"]);
    if($db->checkEmailPasswordCombination($email, $password)){
        $retUser = $db->getUserFromEmail($email);
        $userObj = [];
        $userObj["num_results"] = count($retUser);
        $userObj["results"] = $retUser;
        echo json_encode($userObj);
    } else {
        $userObj = [];
        $userObj["num_results"] = 0;
        $userObj["results"] = NULL;
        $errors = ["username_password_combination" => "Username and password combination is invalid"];
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
    $userObj["errors"] = $errors;
    echo json_encode($userObj);
}
