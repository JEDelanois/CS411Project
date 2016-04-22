<?php
require 'dbconfig.php';
require 'classes/Database.php';







class UserInfo{
    $age;
    $height;
    $weight;
    $targWeight;
    $userId;
    $gender;

    
    
    public function __construct($id){
        $temp=getUserFromID($id);
        
        
        $this->age=$temp->strtotime(user_dob)-date('Y-m-d H:i:s');
        $this->height=$temp->user_height;
        $this->weight=$temp->user_weight;
        $this->gender=$temp->gender;
        $this->userId=$id;
        $this->targWeight=$temp->user_targetweight;
    } 


}

public function get_target_macros($id)
{
    $db= new DatabaseConnection();

    $protein=0;
    $fat=0;
    $carb=0;

    $user=UserInfo($id);
    if($user->targWeight>$user->weight)
    {
        $protein=$user->targWeight;
        $fat=($user->targWeight/2)-2.5;
        $carb=(user->targWeight*2.5)-3;

    }

    elseif(user->targWeight<$user->weight)
    {
        $protein=$user->targWeight;
        $fat=($user->targWeight/2)-2.5;
        $carb=user->targWeight;

    }
    else
    {
        $protein=$user->targWeight;
        $fat=($user->targWeight/2)-2.5;
        $carb=($user->targWeight*1.5)-2;

    }

    return array ($protein, $fat, $carb);

}



public function get_target_macros($id)
{
    $db= new DatabaseConnection();

    $user=UserInfo($id);
    $g=0;
    if($user->gender=="male")
        $g=1;

    $bmi=($user->weight/($user->height*$user->height))*703;
    $bfp=(1.2 *$bmi)+(.24*$user->age)-(10.8*$g)-5.4;

    return array($bmi, $bpf);


}




public function get_macro_day_total($id, $date)
{
    $db= new DatabaseConnection();
    $user=UserInfo($id);
    $date=$date->setTime(0, 0, 0);
    $tommorow=$date.rep
    //set tommorw= to the day after date. !!!!!!!!!!!!

    $ingSQL="SELECT ingredient_id, ingredient_amount FROM NutritionLog WHERE (user_id = :id)";
    $ingSQL=$ingSQL."AND (log_date>= :date)";
    $ingSQL=$ingSQL."AND (log_date <:tomorrow)";
    $ingSQL=$ingSQL."AND (ingredient_id IS NOT NULL);";

    $STH=$this->db->prepare($ingSQL);
    $STH->execute([
        ':id'   =>  $id,
        ':date' =>  $date,
        ':tomorrow' => $tomorrow,
        ]);`
    $ingredientInfo=$STH->fetchALL();
   ///not finished 
    


}


public suggest_rec_by_macros($id, $date)
{
    $macros=get_target_macros($id);
    $consumed=get_macro_day_total($id, $date);
    $remain=array();
    array_push($remain, $macros[0]-$consumed[0]);
    array_push($remain, $macros[1]-$consumed[1]);
    array_push($remain, $macros[2]-$consumed[2]);

    return suggest_rec_by_value(1, remain[0], 1, remain[1], 2, remain[2]);
}


public suggest_rec_by_value($min_p, $max_p, $min_f, $max_f, $min_c, $max_c)
{ 
    $db= new DatabaseConnection();
       
    $ingSQL="SELECT recipe_id FROM Recipes WHERE (recipe_fat <= :max_f) AND (recipe_carbs <= :max_c) AND (recipe_protein <= :max_p) AND (recipe_fat  >= :min_f) AND (recipe_carbs >= min_c ) AND (recipe_protein >= :min_p);"


    $STH=$this->db->prepare($ingSQL);
    $STH->execute([
        ':max_f'   =>  $max_f,
        ':max_c' =>  $max_c,
        ':max_p' => $max_p,
        ':min_f' => $min_f,
        ':min_c' => $min_c,
        ':min_p' => $min_p,
        ]);
    $results=$STH->fetchALL();
    if(results->rowCount==0)
        return None;
    $recRow=results[rand(0, count($result)-1];
    return $recRow[0];
}
?>

