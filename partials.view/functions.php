<?php 
function getTimeString($time){
	$retString = "";
	for($i = 0; $i < strlen($time); $i++){
		if($time[$i] != 'H' && $time[$i] != "M")
			$retString .= $time[$i];
		else
			$retString .= " " . $time[$i] . " ";
	}
	return $retString;
}

function getDirectoryFromURL($requestUrl){
	// $link = $_SERVER["REQUEST_URI"];
	$arr = explode("/", $requestUrl);
	$folder_name = $arr[count($arr) - 2];
	return $folder_name;
}

function getRecipeNameFromAPI($recipeID){
	$url = API_URL . "getRecipe.php?recipe_id=$recipeID";
	$content = file_get_contents($url);
	$recipe = json_decode($content, true);
	// $recipe["results"][0];
	$recipe = $recipe["results"][0];
	return $recipe["recipe_name"];
}