<?php
require '../user_session.php';
require '../config.php';
require 'functions.php';
if(isset($_GET["searchType"])){
    $folder_name = getDirectoryFromURL($_SERVER["REQUEST_URI"]);
    $searchType = htmlentities($_GET["searchType"]);
    if($searchType == "ingredients" && $folder_name != "ingredients"){
        header("Location: ../ingredients/?searchType=ingredients&&s=" . htmlentities($_GET["s"]));
    } else if($folder_name != "recipes"){
    header("Location: ../recipes/?searchType=recipes&&s=" . htmlentities($_GET["s"]));
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nutritions</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require('navbar.php'); ?>
<div class="container-fluid">
