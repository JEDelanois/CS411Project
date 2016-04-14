<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();
$errors = [];

if(isset($_GET["user_id"])){
    $user_id = htmlentities($_GET["user_id"]);
    if(!isset($_GET["date"])){
        $errors["date_error"] = "Date is required";
    } else {
        if(!intval($user_id)){
            $errors["user_id_error"] = "User ID needs to be an int";
        } else {
            if(!$db->getUserFromID($user_id))
                $errors["user_id_error"] = "User does not exist";
            else {
                $date = htmlentities($_GET["date"]);
                $time_of_day = (isset($_GET["time_of_day"])) ? htmlentities($_GET["time_of_day"]) : NULL;

                $ret = $db->getNutritionLogItem($user_id, $date, $time_of_day);

                echo json_encode([
                    "num_results"       =>  count($ret),
                    "results"           =>  $ret,
                    ]);
            }
        }
    }
} else
    $errors["user_id_erros"] = "User ID is required";


if(count($errors) > 0){
    $ingredientObj = [];
    $ingredientObj["num_results"] = 0;
    $ingredientObj["results"] = NULL;
    $ingredientObj["errors"] = $errors;
    echo json_encode($ingredientObj);
}
