<?php 
require "header.view.php";
if($currentUser)
	echo 'Sorry, you are already logged in as ' . $currentUser->user_firstname . ' ' . $currentUser->user_lastname . '<br>';
else
	require "forms/login.form.php";
require "footer.view.php";