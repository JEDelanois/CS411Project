<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();
$errors = [];

if(isset($_GET["search"])){
    $search = htmlentities($_GET["search"]);
} else
    $search = NULL;

if(isset($_GET["recipe_id"])){
    $recipe_id = htmlentities($_GET["recipe_id"]);
    if(!intval($recipe_id)){
        $errors["recipe_id_error"] = "Recipe ID needs to be an integer";
    }
} else
    $recipe_id = NULL;

if(isset($_GET["limit"]))
    $limit = htmlentities($_GET["limit"]);
else
    $limit = NULL;

if(isset($_GET["page"]))
    $page = htmlentities($_GET["page"]);
else
    $page = 1;

if($search)
    $arr = $db->getRecipesSearchString($search, (isset($limit)) ? $limit : NULL, (isset($page) ? $page : 0));
else
    $arr = $db->getRecipe($recipe_id, (isset($limit)) ? $limit : NULL, (isset($page) ? $page : 0));

echo json_encode([
    'num_results'       =>      count($arr),
        'results'           =>      $arr
        ]);

if(count($errors) > 0){
    $ingredientObj = [];
    $ingredientObj["num_results"] = 0;
    $ingredientObj["results"] = NULL;
    $ingredientObj["errors"] = $errors;
    echo json_encode($ingredientObj);
}
