<?php 
require '../../dbconfig.php';
require '../../classes/Database.php';

$user_id = htmlentities($_GET["user_id"]);

$db = new DatabaseConnection();
$db->deleteUserFromID($user_id);

header("Location: ../users.php");