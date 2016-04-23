<?php
// define("CONFIG_FILE_DIR", "../");
// require CONFIG_FILE_DIR . 'dbconfig.php';
// require 'User.php';
// require '../inc/generateRandomRecipe.php';
class DatabaseConnection {
    private $_db = null;
    private $_dbhostname;
    private $_dbname;
    private $_dbusername;
    private $_dbpassword;

    public function __construct(){
        $this->_dbhostname = DB_HOST;
        $this->_dbname = DB_DATABASE;
        $this->_dbusername = DB_USER;
        $this->_dbpassword = DB_PASSWORD;
        try {
            $this->_db = new PDO("mysql:host=$this->_dbhostname;dbname=$this->_dbname", $this->_dbusername, $this->_dbpassword);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function __destruct(){
        $this->_db = null;
    }

    public function insertUserIntoTable($userInfoArray){
        if(is_array($userInfoArray)){
            $sqlQuery = "INSERT INTO `Users`(`user_firstname`, `user_lastname`,`user_email`, `user_password`, `user_role`, `user_last_logged_in`, `user_registered`) VALUES (:firstName, :lastName, :emailAddress, :password, :role, :user_last_logged_in, :user_registered)";
            $STH = $this->_db->prepare($sqlQuery);
            $currTime = date('Y-m-d H:i:s');
            $STH->execute(array(
                ':firstName' 	        => $userInfoArray["user_firstname"],
                ':lastName' 	        => $userInfoArray["user_lastname"],
                ':emailAddress'         => $userInfoArray["user_email"],
                ':password' 	        => $userInfoArray["user_password"],
                ':role'					=> $userInfoArray["user_role"],
                ':user_last_logged_in' 	=> $currTime,
                ':user_registered'      => $currTime
            ));
        }
    }

    public function checkEmailExist($email){
        $sqlQuery = "SELECT user_email FROM Users WHERE user_email = :email";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':email'	=>	$email
            ]);
        $result = $STH->fetch();
        if(isset($result[0])) return true;
        return false;
    }

    public function checkEmailPasswordCombination($email, $password){
        if(!$this->checkEmailExist($email)) return false;
        $sqlQuery = "SELECT user_password FROM Users WHERE user_email = :email";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':email'	=>	$email
            ]);
        $result = $STH->fetch();
        if(password_verify($password, $result[0]))
            return true;
        else return false;
    }

    public function getUserFromEmail($email){
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_weight`, `user_height`, `user_gender`, `user_activity_type`, `user_profile_image`, `user_last_logged_in`, `user_registered`, `user_targetweight` FROM `Users` WHERE user_email = :email";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':email'	=>	$email
            ]);
        return $STH->fetch();
    }

    public function getUserFromID($id){
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_weight`, `user_height`, `user_gender`, `user_activity_type`, `user_profile_image`, `user_last_logged_in`, `user_registered`, `user_targetweight` FROM `Users` WHERE user_id = :id";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':id'	=>	$id
            ]);
        $STH->setFetchMode();
        return $STH->fetch();
    }

    public function getUsersFromTable(){
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_last_logged_in`, `user_registered` FROM `Users` WHERE 1";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_CLASS, "User");
        return $STH->fetchAll(PDO::FETCH_OBJ);
    }

    public function changeUserData($userInfo, $changePassword = false){
        // print_r($userInfo);
        $sqlQuery = "UPDATE `Users` SET `user_role`= :role,`user_firstname`= :firstName,`user_lastname`= :lastName,`user_email`= :emailAddress, user_dob = :user_dob, user_weight = :user_weight, user_targetweight = :user_targetweight, user_height = :user_height, user_gender = :user_gender, user_activity_type = :user_activity_type, user_profile_image = :user_profile_image";
        if($changePassword)
            $sqlQuery .= " ,`user_password`= :password";
        $sqlQuery .= " WHERE user_id = :user_id";
        // echo $sqlQuery;
        // die();
        $STH = $this->_db->prepare($sqlQuery);
        if($changePassword){
            $STH->execute([
                ':firstName' 	        => $userInfo["user_firstname"],
                ':lastName' 	        => $userInfo["user_lastname"],
                ':emailAddress'         => $userInfo["user_email"],
                ':password' 	        => $userInfo["user_password"],
                ':role'					=> $userInfo["user_role"],
                ':user_id'				=> $userInfo["user_id"],
                ':user_dob'             => $userInfo["user_dob"],
                ':user_weight'          => $userInfo["user_weight"],
                ':user_targetweight'    => $userInfo["user_targetweight"],
                ':user_height'          => $userInfo["user_height"],
                ':user_gender'          => $userInfo["user_gender"],
                'user_activity_type'    => $userInfo["user_activity_type"],
                'user_profile_image'    => $userInfo["user_profile_image"]
                ]);
        } else {
            $STH->execute([
                ':firstName' 	        => $userInfo["user_firstname"],
                ':lastName' 	        => $userInfo["user_lastname"],
                ':emailAddress'         => $userInfo["user_email"],
                ':role'					=> $userInfo["user_role"],
                ':user_id'				=> $userInfo["user_id"],
                ':user_dob'             => $userInfo["user_dob"],
                ':user_weight'          => $userInfo["user_weight"],
                ':user_targetweight'    => $userInfo["user_targetweight"],
                ':user_height'          => $userInfo["user_height"],
                ':user_gender'          => $userInfo["user_gender"],
                'user_activity_type'    => $userInfo["user_activity_type"],
                'user_profile_image'    => $userInfo["user_profile_image"]
                ]);
        }
    }

    public function deleteUserFromID($userID){
        $sqlQuery = "DELETE FROM `Users` WHERE user_id = :user_id";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':user_id'		=> $userID
            ]);
    }

    public function getIngredients($ingredientID = NULL, $limit = 30, $page = 1){
        if( (isset($page) && $page < 1) || (isset($limit) && $limit < 0))
            return NULL;
        $sqlQuery = "SELECT * FROM Ingredients";
        if($ingredientID){
            $sqlQuery .= " WHERE ingredient_id = $ingredientID";
        } else if($limit) {
            $sqlQuery .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function getIngredientsSearchString($string, $limit = 30, $page = 1){
        if($string == NULL || $string == "")
            return $this->getIngredients(NULL, $limit, $page);
        if( (isset($page) && $page < 1) || (isset($limit) && $limit < 0))
            return NULL;
        $sqlQuery = "SELECT * FROM Ingredients WHERE ingredient_name LIKE '%$string%'";
        if($limit) {
            $sqlQuery .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function getRecipesSearchString($string, $limit = 30, $page = 1){
        if($string == NULL || $string == "")
            return $this->getRecipes(NULL, $limit, $page);
        if( (isset($page) && $page < 1) || (isset($limit) && $limit < 0))
            return NULL;
        $sqlQuery = "SELECT * FROM Recipes WHERE recipe_name LIKE '%$string%'";
        if($limit) {
            $sqlQuery .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function insertIngredient($ingredient){
        if(is_array($ingredient)){
            $sqlQuery = "INSERT INTO `Ingredients`(`ingredient_name`, `ingredient_protien`, `ingredient_sugar`, `ingredient_carbs`, `ingredient_fat`, `ingredient_source`, `ingredient_serving_size`, `ingredient_changed`, `ingredient_added`) VALUES (:name,:protien,:sugar,:carbs,:fat,:source,:serving_size,:changed_date,:added_date)";
            $STH = $this->_db->prepare($sqlQuery);
            $currTime = date('Y-m-d H:i:s');
            $STH->execute(array(
                ':name'                 =>  (isset($ingredient["ingredient_name"])) ? $ingredient["ingredient_name"] : NULL,
                ':protien'              =>  (isset($ingredient["ingredient_protien"])) ? $ingredient["ingredient_protien"] : NULL,
                ':sugar'                =>  (isset($ingredient["ingredient_sugar"])) ? $ingredient["ingredient_sugar"] : NULL,
                ':carbs'                =>  (isset($ingredient["ingredient_carbs"])) ? $ingredient["ingredient_carbs"] : NULL,
                ':fat'                  =>  (isset($ingredient["ingredient_fat"])) ? $ingredient["ingredient_fat"] : NULL,
                ':source'               =>  (isset($ingredient["ingredient_source"])) ? $ingredient["ingredient_source"] : NULL,
                ':serving_size'         =>  (isset($ingredient["ingredient_serving_size"])) ? $ingredient["ingredient_serving_size"] : NULL,
                ':changed_date' 	    =>  $currTime,
                ':added_date'            =>  $currTime
            ));
        } else {
            echo 'Error! Passed in ingredient must be an array';
        }
    }

    public function addNutritionLogItem($userID, $date, $timeOfTheDay = NULL, $recipeID = NULL, $ingredientID = NULL){
        if(!$this->getUserFromID($userID)){
            echo 'user id is not valid<br>';
            return NULL;
        }
        $sqlQuery = "INSERT INTO `NutritionLog`(`user_id`, `log_date`, `ingredient_id`, `recipe_id`, `log_time_of_the_day`, `log_added_date`) VALUES ( :userID, CAST('$date' AS DATE), :ingredientID,:recipeID,:time_of_the_day,:added_date)";
        $STH = $this->_db->prepare($sqlQuery);
        $currTime = date('Y-m-d H:i:s');
        $STH->execute(array(
            ':userID'               =>  $userID,
           // ':date'                 =>  $logDate,
            ':ingredientID'         =>  $ingredientID,
            ':recipeID'             =>  $recipeID,
            ':time_of_the_day'      =>  $timeOfTheDay,
            ':added_date'           =>  $currTime
        ));

        $sqlQuery = "SELECT * FROM NutritionLog WHERE log_added_date = '$currTime' && user_id = $userID";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }


    public function getNutritionLogItem($userID, $date = NULL, $timeOfTheDay = NULL){
        if(!$this->getUserFromID($userID)){
            echo 'user id is not valid<br>';
            return NULL;
        }
        $sqlQuery = "SELECT * FROM NutritionLog WHERE user_id = $userID";
        if($date){
            $sqlQuery .= " AND log_date = '$date'";
            if($timeOfTheDay)
                $sqlQuery .= " AND log_time_of_the_day = '$timeOfTheDay'";
        }
        $sqlQuery .= " ORDER BY log_date DESC";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function addRecipe($recipeInfo, $ingredients, $directions){
        $sqlQuery = "INSERT INTO `Recipes`(`recipe_name`, `recipe_prep_time`, `recipe_cook_time`, `recipe_ready_in_time`, `recipe_image`, `recipe_categories`, `recipe_source`, `recipe_user_id`, `recipe_calories`, `recipe_fat`, `recipe_carbs`, `recipe_protein`, `recipe_cholesterol`, `recipe_sodium`, `recipe_added_date`) VALUES (:recipe_name, :recipe_prep_time, :recipe_cook_time, :recipe_ready_in_time, :recipe_image, :recipe_categories, :recipe_source, :recipe_user_id, :recupe_calories, :recipe_fat, :recipe_carbs, :recipe_protein, :recipe_cholesterol, :recipe_sodium, :recipe_added_date)";
        $STH = $this->_db->prepare($sqlQuery);
        $currTime = date('Y-m-d H:i:s');
        $STH->execute(array(
            ":recipe_name"                          => (isset($recipeInfo["recipe_name"])) ? $recipeInfo["recipe_name"] : NULL,
            ":recipe_prep_time"                     => (isset($recipeInfo["recipe_prep_time"])) ? $recipeInfo["recipe_prep_time"] : NULL,
            ":recipe_cook_time"                     => (isset($recipeInfo["recipe_cook_time"])) ? $recipeInfo["recipe_cook_time"] : NULL,
            ":recipe_ready_in_time"                 => (isset($recipeInfo["recipe_ready_in_time"])) ? $recipeInfo["recipe_ready_in_time"] : NULL,
            ":recipe_image"                         => (isset($recipeInfo["recipe_image"])) ? $recipeInfo["recipe_image"] : NULL,
            ":recipe_categories"                    => (isset($recipeInfo["recipe_categories"])) ? $recipeInfo["recipe_categories"] : NULL,
            ":recipe_source"                        => (isset($recipeInfo["recipe_source"])) ? $recipeInfo["recipe_source"] : NULL,
            ":recipe_user_id"                       => (isset($recipeInfo["recipe_user_id"])) ? $recipeInfo["recipe_user_id"] : NULL,
            ":recupe_calories"                      => (isset($recipeInfo["recipe_calories"])) ? $recipeInfo["recipe_calories"] : NULL,
            ":recipe_fat"                           => (isset($recipeInfo["recipe_fat"])) ? $recipeInfo["recipe_fat"] : NULL,
            ":recipe_carbs"                         => (isset($recipeInfo["recipe_carbs"])) ? $recipeInfo["recipe_carbs"] : NULL,
            ":recipe_protein"                       => (isset($recipeInfo["recipe_protein"])) ? $recipeInfo["recipe_protein"] : NULL,
            ":recipe_cholesterol"                   => (isset($recipeInfo["recipe_cholesterol"])) ? $recipeInfo["recipe_cholesterol"] : NULL,
            ":recipe_sodium"                        => (isset($recipeInfo["recipe_sodium"])) ? $recipeInfo["recipe_sodium"] : NULL,
            ":recipe_added_date"                    => $currTime
        ));

        $sqlQuery = "SELECT * FROM `Recipes` WHERE `recipe_name` = '" . $recipeInfo["recipe_name"] . "' AND `recipe_added_date` = '$currTime'";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $recipeArr = $STH->fetchAll();
        $recipeID = $recipeArr[0]['recipe_id'];

        $recipeArr["ingredients"] = $this->insertIntoContains($recipeID, $ingredients);

        $recipeArr["directions"] = $this->insertIntoRecipeDirection($recipeID, $directions);

        return $recipeArr;
    }

    private function insertIntoContains($recipeID, $ingredients){
        if(is_array($ingredients) && count($ingredients) > 0){
            $sqlQuery = "INSERT INTO `Contains`(`recipe_id`, `ingredient_text`) VALUES ";
            $count = 0;
            foreach($ingredients as $ing){
                if($count == 0){
                    $sqlQuery .= "($recipeID, '$ing')";
                    $count = 1;
                } else {
                    $sqlQuery .= ",($recipeID, '$ing')";
                }
            }
            $STH = $this->_db->prepare($sqlQuery);
            $STH->execute();
            return $ingredients;
        } else
            return NULL;
    }

    private function insertIntoRecipeDirection($recipeID, $directions){
        if(is_array($directions) && count($directions) > 0){
            $sqlQuery = "INSERT INTO `RecipeDirection`(`recipe_id`, `direction_number`, `direction_text`) VALUES ";
            foreach($directions as $key => $direc){
                if($key == 1){
                   $sqlQuery .= "($recipeID, $key, '$direc')";
                } else {
                    $sqlQuery .= ",($recipeID, $key, '$direc')";
                }
            }
            $STH = $this->_db->prepare($sqlQuery);
            $STH->execute();
            return $directions;
        } else
            return NULL;
    }

    public function getRecipe($recipeID = NULL, $limit = NULL, $page = 1){

        if( (isset($page) && $page < 1) || (isset($limit) && $limit < 0))
            return NULL;

        $sqlQuery = "SELECT * FROM Recipes";

        if($recipeID){
            $sqlQuery .= " WHERE recipe_id = $recipeID";
        } else if($limit) {
            $sqlQuery .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $recipeArr = $STH->fetchAll();
        for($i = 0; $i < count($recipeArr); $i++){
            // get the ingredients
            $recipeArr[$i]["ingredients"] = $this->getIngredientsOfRecipe($recipeArr[$i]["recipe_id"]);
            // get directions
            $recipeArr[$i]["directions"] = $this->getDirectionsOfRecipe($recipeArr[$i]["recipe_id"]);
        }
        return $recipeArr;
    }

    public function getIngredientsOfRecipe($recipeID){
        $sqlQuery = "SELECT ingredient_text FROM Contains WHERE recipe_id = $recipeID";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function getDirectionsOfRecipe($recipeID){
        $sqlQuery = "SELECT direction_number, direction_text FROM RecipeDirection WHERE recipe_id = $recipeID";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $arr = $STH->fetchAll();

        $directions = [];

        foreach($arr as $dir)
            $directions[$dir["direction_number"]] = $dir["direction_text"];

        return $directions;
    }

    public function getNumElements($tableName){
        $sqlQuery = "SELECT Count(*) FROM $tableName";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $arr = $STH->fetchAll();

        if($arr)
            return $arr[0][0];
        else
            return NULL;

    }

    public function suggest_rec_by_value($min_p, $max_p, $min_f, $max_f, $min_c, $max_c)
    {
//        $db= new DatabaseConnection();

        $ingSQL="SELECT recipe_id FROM Recipes WHERE (recipe_fat <= :max_f) AND (recipe_carbs <= :max_c) AND (recipe_protein <= :max_p) AND (recipe_fat  >= :min_f) AND (recipe_carbs >= :min_c ) AND (recipe_protein >= :min_p)";

        $STH=$this->_db->prepare($ingSQL);
        $STH->execute([
            ':max_f'   =>  $max_f,
            ':max_c' =>  $max_c,
            ':max_p' => $max_p,
            ':min_f' => $min_f,
            ':min_c' => $min_c,
            ':min_p' => $min_p,
            ]);
        $results=$STH->fetchAll();


        if(count($results) == 0)
            return NULL;
        $recRow = $results[rand(0, count($results)-1)];
        return $recRow[0];
    }


public function get_macro_day_total($id, $date)
{
    $user = new UserInfo($id);
    $date = $date->setTime(0, 0, 0);
    $tomorrow=$date;
    date_modify($tomorrow, '+1 day');
    //set tommorw= to the day after date. !!!!!!!!!!!!

    $ingSQL="SELECT ingredient_id, ingredient_amount FROM NutritionLog WHERE (user_id = :id)";
    $ingSQL .= " AND (log_date>= :date)";
 //   $ingSQL .= " AND (log_date < :tomorrow)";
    $ingSQL .= " AND (ingredient_id IS NOT NULL);";

    $STH=$this->_db->prepare($ingSQL);
    $STH->execute([
        ':id'   =>  $id,
        ':date' => date_format($date, "Y-m-d"),
        // ':tomorrow' => date_format($tomorrow, "Y-m-d"),
        ]);
    $ingredientInfo=$STH->fetchAll();


    $ingSQL="SELECT recipe_id FROM NutritionLog WHERE (user_id = :id)";
    $ingSQL .= " AND (log_date >= :date)";
 //   $ingSQL .= " AND (log_date < :tomorrow)";
 /*   $ingSQL .= " AND (recipe_id IS NOT NULL);";*/

    $STH=$this->_db->prepare($ingSQL);
    $STH->execute([
        ':id'   =>  $id,
        ':date' =>  date_format($date, "Y-m-d"),
// ':tomorrow' => date_format($tomorrow, "Y-m-d"),
        ]);
    $recipeInfo=$STH->fetchALL();


    $ingrTotalProtein = 0; $ingrTotalFat = 0; $ingrTotalCarbs = 0;

    foreach($ingredientInfo as $ingr){
       $sqlStatement = "SELECT ingredient_protien, ingredient_fat, ingredient_carbs, ingredient_serving_size FROM Ingredients WHERE ingredient_id = :id";

    $STH=$this->_db->prepare($sqlStatement);
    $STH->execute([
        ':id'   =>  $ingr["ingredient_id"]
        ]);
    $singleIngrInfo = $STH->fetchAll();

        if(count($singleIngrInfo) > 0){
            $singleIngrInfo = $singleIngrInfo[0];
            $ingrTotalProtein += $singleIngrInfo["ingredient_protien"];
            $ingrTotalFat += $singleIngrInfo["ingredient_fat"];
            $ingrTotalCarbs += $singleIngrInfo["ingredient_carbs"];
        }
    }

    foreach($recipeInfo as $recipe){
        if(!$recipe["recipe_id"])
            continue;
       $sqlStatement = "SELECT `recipe_protein`, `recipe_fat`, `recipe_carbs` FROM `Recipes` WHERE recipe_id = :id";


    $STH=$this->_db->prepare($sqlStatement);
    $STH->execute([
        ':id'   =>  $recipe["recipe_id"]
        ]);
    $singleIngrInfo = $STH->fetchAll();

        if(count($singleIngrInfo) > 0){
            $singleIngrInfo = $singleIngrInfo[0];
            $ingrTotalProtein += $singleIngrInfo["recipe_protein"];
            $ingrTotalFat += $singleIngrInfo["recipe_fat"];
            $ingrTotalCarbs += $singleIngrInfo["recipe_carbs"];
        }
    }

}
}


class UserInfo {
    public $age;
    public $height;
    public $weight;
    public $targetweight;
    public $userId;
    public $gender;
    public $db;

    public function __construct($id){
        $db = new DatabaseConnection();
        $temp= $db->getUserFromID($id);

        $this->age = strtotime($temp["user_dob"]) - strtotime(date('Y-m-d H:i:s'));
        $this->height=$temp["user_height"];
        $this->weight=$temp["user_weight"];
        $this->gender=$temp["user_gender"];
        $this->userId=$id;
        $this->targetweight=$temp["user_targetweight"];
    }


}

function get_target_macros($id)
{

    $protein=0;
    $fat=0;
    $carb=0;

    $user= new UserInfo($id);

    if($user->targetweight > $user->weight)
    {
        $protein = $user->targetweight;
        $fat= ($user->targetweight / 2) - 2.5;
        $carb = ($user->targetweight*2.5)-3;

    }

    elseif($user->targetweight < $user->weight)
    {
        $protein=$user->targetweight;
        $fat=($user->targetweight/2)-2.5;
        $carb= $user->targetweight;

    }
    else
    {
        $protein=$user->targetweight;
        $fat=($user->targetweight/2)-2.5;
        $carb=($user->targetweight*1.5)-2;

    }

    return array ($protein, $fat, $carb);

}



function get_body_comp($id)
{

    $user= new UserInfo($id);

    $g=0;
    if($user->gender=="male")
        $g=1;

    $bmi=($user->weight/($user->height*$user->height))*703;
    $bfp=(1.2 *$bmi)+(.24*$user->age)-(10.8*$g)-5.4;

    return array($bmi, $bfp);


}




// suggest recipe

function suggest_rec_by_macros($id, $date)
{
    $macros=get_target_macros($id);
    $db = new DatabaseConnection();
    $consumed= $db->get_macro_day_total($id, $date);
    $remain=array();
    array_push($remain, $macros[0]-$consumed[0]);
    array_push($remain, $macros[1]-$consumed[1]);
    array_push($remain, $macros[2]-$consumed[2]);

    return $db->suggest_rec_by_value(1, $remain[0], 1, $remain[1], 2, $remain[2]);
}
