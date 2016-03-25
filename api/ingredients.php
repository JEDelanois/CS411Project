<?php
require '../dbconfig.php';
require '../classes/Database.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$ingredients = [];
$results = $db->getAllIngredients();
$results = array_slice($results, 0, 30);
$ingredients['num_results'] = count($results);
$ingredients['results'] = $results;

echo json_encode($ingredients);
