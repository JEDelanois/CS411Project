<?php
require '../user_session.php';
require '../config.php';

if(isset($_POST)){
    $user_email = htmlentities($_POST["loginFormEmailTextField"]);
    $password = htmlentities($_POST["passwordTextField"]);

    $str = API_URL . "loginUser.php?";

    $user_email ? $str .= "email=$user_email&&" : "";
    $password ? $str .= "password=$password" : "";

    $content = file_get_contents($str);

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
