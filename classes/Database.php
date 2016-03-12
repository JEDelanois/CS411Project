<?php 
require '../dbconfig.php';
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
			$sqlQuery = "INSERT INTO `Users`(`user_first_name`, `user_last_name``user_email`, `user_password`, `user_dob`, `user_role`, `user_last_logged_in`, `user_registered`) VALUES (:firstName, :lastName, :emailAddress, :password, :DOB, :role, :user_last_logged_in, :user_registered)";
			$STH = $this->_db->prepare($sqlQuery);
			$currTime = date('Y-m-d H:i:s');
			$STH->execute(array(
				':firstName' 	=> $userInfoArray["firstname"],
				':lastName' 	=> $userInfoArray["lastname"],
				':emailAddress' => $userInfoArray["emailAddress"],
				':password' 	=> $userInfoArray["password"],
				':role'			=> $userInfoArray["role"],
				':user_last_logged_in' 	=> $currTime,
				':user_registered' => $currTime
			));
		} 
	}

	public function insertNewCandidateIntoTable($candidateObj){
		try {
			$sqlQuery = "";
			$currTime = date('Y-m-d H:i:s');
			$STH = $this->_db->prepare($sqlQuery);
			$STH->execute(array(
				
			));
		} catch(PDOException $e){
			echo $e->getMessage();
			    die();
		}
	}
}