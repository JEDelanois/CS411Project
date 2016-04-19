<?php
require '../dbconfig.php';
require '../classes/Database.php';
require '../libs/password.php';
require '../functions.php';
header("Content-Type: application/json");

$db = new DatabaseConnection();

$errors = [];

if(isset($_GET["recipe_name"])){

    $info = [];
    $ingr = [];
    $ingredientStr = "ingredient";
    $direc = [];
    $direcStr = "direction";
    foreach($_GET as $key => $value){
        if(substr($key, 0, strlen($ingredientStr)) == $ingredientStr)
            array_push($ingr, htmlentities($value));
        else if(substr($key, 0, strlen($direcStr)) == $direcStr)
            $direc[intval(substr($key, strlen($direcStr), strlen($key) - strlen($direcStr)))] = $value;
        else if($key == "recipe_image" && substr($value, 0, 4) == "http"){
            $arr["recipe_image"] = downloadImage(htmlentities($value));
        } else
            $arr[htmlentities($key)] = htmlentities($value);
    }
    echo json_encode([
        'num_results'   =>  1,
        'results'       =>  $db->addRecipe($arr, $ingr, $direc)
        ]);

} else {
    $errors["name_error"] = "Recipe name is required.";
}


if(count($errors) > 0){
    $ingredientObj = [];
    $ingredientObj["num_results"] = 0;
    $ingredientObj["results"] = NULL;
    $ingredientObj["errors"] = $errors;
    echo json_encode($ingredientObj);
}


function downloadImage($url){
    $arr = explode( "/", $url);

    $origName = $arr[count($arr) - 1];
    $fileExt = (explode('.', $origName));
    $fileExt = strtolower(end($fileExt));
    $dest = '../images/recipeImages';
    $newFileName = uniqid('recipeImage_', true) . '.' . $fileExt;
    $file_dest = $dest . "/" . $newFileName;
    // copy($url, $file_dest);
    $content = file_get_contents($url);
    file_put_contents($file_dest, $content);
    return $newFileName;
}
