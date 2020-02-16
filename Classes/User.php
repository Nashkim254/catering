<?php
include_once('./Database.php');
session_start();
/**
 * This class represent a user of the system
 */
class User
{
	
private $first_name;//First name of the user
private $last_name;//last name of the user
private $email;//Email of the user
private $username; //Username for accessing the system
private $password; //Password for the system

private $user_type; //Usertype admin, client or record manager


//Create a constructor

// USERS(FIRST_NAME,LAST_NAME,EMAIL,USERNAME,PASSWORD,USER_TYPE,REGISTER_DATE)
	function __construct($first_name,$last_name,$email,$username, $password,$user_type)
	{
		$this->first_name=$first_name;
		$this->last_name=$last_name;
		$this->email=$email;
		$this->username=$username;
		$this->password= password_hash($password, PASSWORD_DEFAULT);//Hash the password
		$this->user_type=$user_type;
		
	}
//Adds a new User to the database
	public function add(){
		if (Database::record_exist('USERS','USERNAME',$this->username) or Database::record_exist('USERS','EMAIL',$this->email)  ) {
			return 'Username or email taken';
		}else{
			Database::add('USERS',array($this->first_name,$this->last_name,$this->email,$this->username,$this->password,$this->user_type));
			return 'Registration succesfull';
		}
		
	}

//Veryfies if the user is in the system and the passsword entered is the correct one and then sets the session variables
	public static function login($email_username, $password){
		$conncetion = Database::connect();
		if($conncetion != null){
		$stmt = $conncetion->prepare("SELECT * FROM USERS WHERE USERNAME = '$email_username' OR EMAIL = '$email_username'"); 
		$stmt->execute(); 
		
		if($row = $stmt->fetch()){
			if (password_verify($password, $row['PASSWORD'])) {
			$_SESSION['username'] = $row['USERNAME'];
			$_SESSION['id'] = $row['ID'];
			$_SESSION['email'] = $row['EMAIL'];
			$_SESSION['user_type'] = $row['USER_TYPE'];
			$_SESSION['name']= $row['FIRST_NAME']."   ".$row['LAST_NAME'];
			return null;
			}else{
				return 'INCORRECT_PASSWORD';
			}



		}else{
			return "UNREGISTERED";
		}
		$connection = null; //DestroyDatabase:: connection
		$stmt=null;
		}

	}
//Update User details
		public static function update($attr,$new,$pk){
		Database::update('USERS',$attr,$new,$pk);
	}

		//Delete record
	public static function delete($pk){
		Database::delete('USERS',$pk);
	}
}

//$user = new User('Nashon','Kimutai','kimutainashon@gmail.com','nash','nashkim1','ADMIN');
//$user->add();
  ?>