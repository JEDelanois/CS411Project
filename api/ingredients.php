<?php
require '../dbconfig.php';
require '../classes/Database.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$ingredients = [];

if(isset($_GET["id"]))
	$id = htmlentities($_GET["id"]);
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

$results = $db->getAllIngredients($id, $page, $limit);
// $results = array_slice($results, 0, 30);
$ingredients['num_results'] = count($results);
$ingredients['results'] = $results;

echo json_encode($ingredients);
