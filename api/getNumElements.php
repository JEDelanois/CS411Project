<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$errors = [];

if(isset($_GET["table_name"])){

    $result = $db->getNumElements(htmlentities($_GET["table_name"]));

    if($result == NULL){
        $errors["table_name_error"] = "Table does not exist";
    } else {
        echo json_encode([
            'num_results'   => 1,
            'result'        => $result
        ]);
    }

} else {
    $errors["table_name_error"] = "Table name is required.";
}

if(count($errors) > 0){
    $ingredientObj = [];
    $ingredientObj["num_results"] = 0;
    $ingredientObj["results"] = NULL;
    $ingredientObj["errors"] = $errors;
    echo json_encode($ingredientObj);
}
