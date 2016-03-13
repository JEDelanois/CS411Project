<?php 

class User {
	private $_firstName;
	private $_lastName;
	private $_emailAddress;
	private $_dob;
	private $_role;

	public function __construct($firstname, $lastname, $emailAddress, $dob, $role = "user"){
		$this->_firstName = $firstname;
		$this->_lastName = $lastname;
		$this->_emailAddress = $emailAddress;
		$this->_dob = $dob
		$this->_role = $role	
	}

	public function getFirstName(){
		return $_firstName;
	}

	public function getLastName(){
		return $_lastName;
	}

	public function getFullName(){
		return $_firstName . $_lastName;
	}

	public function getEmailAddress(){
		return $_emailAddress;
	}

	public function getDOB(){
		return $_dob;
	}

	public function getRole(){
		return $_role;
	}

	public function setFirstName($firstname){
		$this->_firstName = $firstname;
	}

	public function setLastName($lastname){
		$this->_lastName = $lastname;
	}

	public function setEmailAddress($email){
		$this->_emailAddress = $email;
	}

	public function setDOB($dob){
		$this->_dob = $dob;
	}

	public function setRole($role){
		$this->_role = $role;
	}

}