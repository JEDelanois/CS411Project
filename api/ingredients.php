<?php
require '../dbconfig.php';
require '../classes/Database.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$ingredients = [];
$results = $db->getAllIngredients();
$ingredients['num_results'] = count($results);
$ingredients['results'] = $results;

echo json_encode($ingredients);
