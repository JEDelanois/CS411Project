<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$errors = [];

if(isset($_GET['name'])){
    $ingredient = [];

    $ingredient["ingredient_name"] = htmlentities($_GET["name"]);

    if(isset($_GET["protien"])){
        $protien = htmlentities($_GET["protien"]);
        if(!intval($protien) && $protien[0] != '0')
           $errors["ingredient_protien_error"] = "Ingredient's protien amount should be a number";
        else
            $ingredient["ingredient_protien"] = $protien;
    } else
        $ingredient["ingredient_protien"] = NULL;

    if(isset($_GET["sugar"])){
        $sugar = htmlentities($_GET["sugar"]);
        if(!intval($sugar) && $sugar[0] != '0')
            $errors["ingredient_sugar_error"] = "Ingredient's sugar amount should be anumber";
        else
            $ingredient["ingredient_sugar"] = $sugar;
    } else
        $ingredient["ingredient_sugar"] = NULL;

    if(isset($_GET["carbs"])){
        $carbs = htmlentities($_GET["carbs"]);
        if(!intval($carbs) && $carbs != '0')
            $errors["ingredient_carbs_error"] = "Ingredient's carbs amount should be a number";
        else
            $ingredient["ingredient_carbs"] = $carbs;
    } else
        $ingredient["ingredient_carbs"] = NULL;

    if(isset($_GET["fat"])){
        $fat = htmlentities($_GET["fat"]);
        if(!intval($fat) && $fat != '0')
            $errors["ingredient_fat_error"] = "Ingredient's fat amount should be a number";
        else
            $ingredient["ingredient_fat"] = $fat;
    } else
        $ingredient["ingredient_fat"] = NULL;

    if(isset($_GET["source"]))
        $ingredient["ingredient_source"] = htmlentities($_GET["source"]);
    else
        $ingredient["ingredient_source"] = NULL;

    if(isset($_GET["serving_size"])){
        $serving_size = htmlentities($_GET["serving_size"]);
        if(!intval($serving_size) && $serving_size[0] != '0')
            $errors["ingredient_serving_size"] = "Serving size should be a number";
        else
            $ingredient["ingredient_serving_size"] = $serving_size;
    } else
        $ingredient["ingredient_serving_size"] = NULL;

    if(count($errors) == 0){
        $db->insertIngredient($ingredient);
        $ingredientObj = [];
        $ingredientObj["num_results"] = 1;
        $ingredientObj["results"] = $ingredient;
        echo json_encode($ingredientObj);
    }
} else {
    $errors["name_error"] = "Name is required";
}


if(count($errors) > 0){
    $ingredientObj = [];
    $ingredientObj["num_results"] = 0;
    $ingredientObj["results"] = NULL;
    $ingredientObj["errors"] = $errors;
    echo json_encode($ingredientObj);
}
