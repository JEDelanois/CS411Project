<?php
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

        $this->age = strtotime($temp["user_dob"]) - date('Y-m-d H:i:s');
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

    $user=UserInfo($id);
    $g=0;
    if($user->gender=="male")
        $g=1;

    $bmi=($user->weight/($user->height*$user->height))*703;
    $bfp=(1.2 *$bmi)+(.24*$user->age)-(10.8*$g)-5.4;

    return array($bmi, $bpf);


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


?>

