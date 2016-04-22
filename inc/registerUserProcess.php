<?php
require '../config.php';
require '../user_session.php';

if(isset($_POST)){
	// create an array to store the user information
	$firstName = htmlentities($_POST["registrationFormFirstNameTextField"]);
	$lastName = htmlentities($_POST["registrationFormLastNameTextField"]);
	$email = htmlentities($_POST["registrationFormEmailTextField"]);
    $password  = htmlentities($_POST["passwordTextField"]);

    $url = API_URL . "registerUser.php?";
/*
    echo '<pre>';
    print_r($userInfo);
    echo '</pre>';*/

    if($firstName)
        $url .= "firstname=$firstName&&";
    if($lastName)
        $url .= "lastname=$lastName&&";
    if($email)
        $url .= "email=$email&&";
    if($password)
        $url .= "password=$password";

    $content = file_get_contents($url);

    $result = json_decode($content, true);
    $user = $result["results"];

    if($user){
        setCurrentUser($user);
        header('Location: ' . strtok($_SERVER['HTTP_REFERER'], "?"));
    } else {
        $errString = "";
        $errors = $result["errors"];
        $count = 1;
        foreach($errors as $error){
            $errString .= "&&login_registration_error_$count=$error";
            $count++;
        }
        $count--;
        header('Location: ' . strtok($_SERVER['HTTP_REFERER'], "?") . "?login_registration_error=$count$errString");
    }
}
