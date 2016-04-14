<?php
// define("CONFIG_FILE_DIR", "../");
// require CONFIG_FILE_DIR . 'dbconfig.php';
// require 'User.php';

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
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_weight`, `user_height`, `user_gender`, `user_activity_type`, `user_profile_image`, `user_last_logged_in`, `user_registered` FROM `Users` WHERE user_email = :email";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':email'	=>	$email
            ]);
        $STH->setFetchMode(PDO::FETCH_CLASS, "User");
        return $STH->fetch(PDO::FETCH_OBJ);
    }

    public function getUserFromID($id){
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_weight`, `user_height`, `user_gender`, `user_activity_type`, `user_profile_image`, `user_last_logged_in`, `user_registered` FROM `Users` WHERE user_id = :id";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute([
            ':id'	=>	$id
            ]);
        $STH->setFetchMode(PDO::FETCH_CLASS, "User");
        return $STH->fetch(PDO::FETCH_OBJ);
    }

    public function getUsersFromTable(){
        $sqlQuery = "SELECT `user_id`, `user_role`, `user_firstname`, `user_lastname`, `user_email`, `user_dob`, `user_last_logged_in`, `user_registered` FROM `Users` WHERE 1";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_CLASS, "User");
        return $STH->fetchAll(PDO::FETCH_OBJ);
    }

    public function changeUserData($userInfo, $changePassword = false){
        $sqlQuery = "UPDATE `Users` SET `user_role`= :role,`user_firstname`= :firstName,`user_lastname`= :lastName,`user_email`= :emailAddress, user_dob = :user_dob, user_weight = :user_weight, user_height = :user_height, user_gender = :user_gender, user_activity_type = :user_activity_type, user_profile_image = :user_profile_image";
        if($changePassword)
            $sqlQuery .= " ,`user_password`= :password";
        $sqlQuery .= " WHERE user_id = :user_id";
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

    public function getAllIngredients(){
        $sqlQuery = "SELECT * FROM Ingredients WHERE 1";
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function getIngredientsSearchString($string){
        $sqlQuery = "SELECT * FROM Ingredients WHERE ingredient_name LIKE '%$string%'";
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
        $STH = $this->_db->prepare($sqlQuery);
        $STH->execute();
        return $STH->fetchAll();
    }
}
