<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();


if(isset($_GET["id"]) || isset($_GET["email"])){
    if(isset($_GET["id"])){
        $user_id = htmlentities($_GET["id"]);
        $user = $db->getUserFromID($user_id);
        if($user == NULL){
            echo json_encode([
                'num_results'   =>  0,
                'results'       => null,
                'errors'        => [
                    'id_error'      =>  'User does not exist',
                ],
               ]);
            return;
        }
    } else {
        $user_email = htmlentities($_GET["email"]);
        $user = $db->getUserFromEmail($user_email);
        if($user == NULL){
            echo json_encode([
                'num_results'   =>  0,
                'results'       => null,
                'errors'        => [
                    'email_error'      =>  'User does not exist',
                ],
               ]);
            return;
        }
    }

    echo json_encode([
        'num_results'   =>  1,
        'results'       =>  $user,
        ]);

} else {
    $userObj = [];
    $userObj["num_results"] = 0;
    $userObj["results"] = NULL;
    $errors = [
        "email_or_id_error" => "Email address or the id of the user is required"
        ];
    $userObj["errors"] = $errors;
    echo json_encode($userObj);
}
