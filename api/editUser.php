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

    $user = (array) $user;

/*    echo '<pre>';
    print_r($user);
    echo '</pre>';*/

    if(isset($_GET["firstname"]))
        $user["user_firstname"] = htmlentities($_GET["firstname"]);
    if(isset($_GET["lastname"]))
        $user["user_lastname"] = htmlentities($_GET["lastname"]);
    if(isset($_GET["new_email"]))
        $user["user_email"] = htmlentities($_GET["new_email"]);
    if(isset($_GET["password"])){
        $user["user_password"] = htmlentities($_GET["password"]);
        $user["user_password"] = password_hash($user["user_password"], PASSWORD_DEFAULT);
    }
    if(isset($_GET["dob"]))
        $user["user_dob"] = htmlentities($_GET["dob"]);
    if(isset($_GET["weight"]))
        $user["user_weight"] = htmlentities($_GET["weight"]);
    if(isset($_GET["height"]))
        $user["user_height"] = htmlentities($_GET["height"]);
    if(isset($_GET["gender"]))
        $user["user_gender"] = htmlentities($_GET["gender"]);
    if(isset($_GET["activity_type"]))
        $user["user_activity_type"] = htmlentities($_GET["activity_type"]);
    if(isset($_GET["profile_image"]))
        $user["user_profile_image"] = htmlentities($_GET["profile_image"]);

   $db->changeUserData($user, (isset($_GET["password"])) ? true : false);
    echo json_encode($db->getUserFromID($user["user_id"]));

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
