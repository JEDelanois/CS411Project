<?php 
if(!isset($_GET["user_id"])) 
	header("Location: ../404.php");
else {
	require 'header.view.php';
	if(isset($currentUser) && ($currentUser->user_id == $_GET["user_id"] || $currentUser->user_role == "administrator")){
		require 'forms/editUser.form.php';
		require 'footer.view.php';
	} else {
		echo 'you do not have permission to access this webpage <br>';
	}
}