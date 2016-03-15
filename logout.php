<?php 
require 'user_session.php';
if($currentUser){
	setCurrentUser(NULL);
}

header("Location: index.php");