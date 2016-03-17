<?php 
class User {
	public $user_id, $user_role, $user_firstname, $user_lastname, $user_email, 
		   $user_dob, $user_last_logged_in;

	public function __construct($userArray = NULL){
		if($userArray){
			$this->user_firstname = $userArray["user_firstname"];
			$this->user_lastname = $userArray["user_lastname"];
			$this->user_email = $userArray["user_email"];
			if(isset($userArray["user_dob"]))
				$this->user_dob = $userArray["user_dob"];
			else
				$this->user_dob = NULL;
			$this->user_role = $userArray["user_role"];
			$this->user_last_logged_in = NULL;
		}
	}

}