<?php
require '../dbconfig.php';
require '../classes/Database.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$ingredients = [];

if(isset($_GET["ingredient_id"]))
	$id = htmlentities($_GET["ingredient_id"]);
else
	$id = NULL;

if(isset($_GET["page"]))
	$page = htmlentities($_GET["page"]);
else
	$page = 1;

if(isset($_GET["limit"]))
	$limit = htmlentities($_GET["limit"]);
else
	$limit = 30;

if(isset($_GET["search"]))
    $search = htmlentities($_GET["search"]);
else
    $search = NULL;

if(isset($_GET["search"]))
    $results = $db->getIngredientsSearchString($search, $limit, $page);
else
    $results = $db->getIngredients($id, $limit, $page);
// $results = array_slice($results, 0, 30);
$ingredients['num_results'] = count($results);
$ingredients['results'] = $results;

echo json_encode($ingredients);
