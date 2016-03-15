<?php 
class User {
	public $user_id, $user_role, $user_firstname, $user_lastname, $user_email, 
		   $user_dob, $user_last_logged_in;

	public function __construct($userArray = NULL){
		if($userArray){
			$this->_firstName = $firstname;
			$this->_lastName = $lastname;
			$this->_emailAddress = $emailAddress;
			$this->_dob = $dob;
			$this->_role = $role;
		}
	}

}