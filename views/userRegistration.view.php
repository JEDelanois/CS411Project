<?php 
require 'views/header.view.php';
echo "<h1>User Registration</h1>";
if($currentUser)
	echo 'Sorry, you are already registered as ' . $currentUser->user_firstname . ' ' . $currentUser->user_lastname . '<br>';
else
	require 'forms/userRegistration.form.php';
require 'views/footer.view.php';