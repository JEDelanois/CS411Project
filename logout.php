<?php
require 'user_session.php';
if($currentUser){
	setCurrentUser(NULL);
}

header('Location: ' . strtok($_SERVER['HTTP_REFERER'], "?"));
