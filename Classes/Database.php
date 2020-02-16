<?php 
/**
 * This Class Will HelpDatabase:: Connectiong To The MySql DataBase
 *All The methods and variables in this class are static
 */
class Database
{
	
private static $username = 'root';//Username as in the MySql Database. Change appropriately
private static $database_name = 'Catering_Department'; //Database Name
private static $connection = null;//Database:: Connection to the Database. Initially set to null
private static $password = ''; //Password to the database. Change the value as suits
private static $host = 'localhost';///Connection therough the localhost


//This function creats aDatabase:: connection to the database and sets theDatabase:: connection.
//It returns  theDatabase:: connection which can be used in other Classes
//InitialDatabase:: connection before database is created
private static function connectiInitial(){
  try {
  	$myhost = Database::$host;
    Database::$connection = new PDO("mysql:host=$myhost", Database::$username, Database::$password);
    // set the PDO error mode to exception
    Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return Database::$connection; 
    }
catch(PDOException $e)
    {
     echo  $e->getMessage(). "<br>";
    return null;
    }
 //End of connect()
}

//Connect to the database after a database has been created
public static function connect(){
  try {
  	$myhost = Database::$host;
  	$mydb = Database::$database_name;
    Database::$connection =  new PDO("mysql:host=$myhost;dbname=$mydb", Database::$username, Database::$password);
    // set the PDO error mode to exception
    Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return Database::$connection; 
    }
catch(PDOException $e)
    {
     echo  $e->getMessage(). "<br>";
    return null;
    }
 //End of connect()
}

//This Method creates the Database. Of course if it does exist

public static function create_db(){
	Database::connectiInitial();//Connect to the database
	//If we were lucky to connect
	if (Database::$connection!=null) {
		$sql="CREATE DATABASE IF NOT EXISTS ".Database::$database_name;//Create sql query
		Database::$connection->exec($sql);//Execute the query
		Database::$connection = null;//DestroyDatabase:: connection after use
		return true;
	}
	echo "Could not createDatabase:: connection"."<br>";
	return false;
//Cnd of create_db()
}



//Creates all the tables that we will need to use USERS, RECORDS, ORDERS

public  static function createTables(){
	Database::connect();
	if(Database::$connection != null){

		//CREATE USERS TABLE
		$sql = "CREATE TABLE IF NOT EXISTS USERS(
		ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		FIRST_NAME VARCHAR(50) NOT NULL,
		LAST_NAME VARCHAR (50) NOT NULL,
		EMAIL VARCHAR (100) UNIQUE KEY NOT NULL,
		USERNAME VARCHAR (50) UNIQUE KEY NOT NULL,
		PASSWORD VARCHAR (250) NOT NULL,
		USER_TYPE ENUM('ADMIN','STORE_MANAGER','CASHIER'),
		REGISTER_DATE DATE NOT NULL,
		REGISTER_TIME TIME NOT NULL
	)";
	Database::$connection->exec($sql);//Execute the query
		//CREATE ITEM IN STORE TABLE
		$sql = " CREATE TABLE IF NOT EXISTS STORE_ITEMS(
			ID INT (11) PRIMARY KEY  NOT NULL AUTO_INCREMENT,
			ITEM_NAME  VARCHAR (100) UNIQUE KEY NOT NULL,
			UNIT VARCHAR (20) NOT NULL,
			ITEM_QUANTITY INT(11) NOT NULL,
			UNIT_PRICE FLOAT NOT NULL,

			DATE_ADDED DATE NOT NULL,
			TIME_ADDED TIME NOT NULL,

			DATE_LAST_MODIFIED DATE NOT NULL,
			TIME_MOD TIME NOT NULL
		)";
		Database::$connection->exec($sql);//Execute the query

	//CREATE SPECIAL_ORDERS TABLE

		$sql="CREATE TABLE IF NOT EXISTS SPECIAL_ORDERS(
			ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			GROUP_NAME VARCHAR(100) NOT NULL,
			CONTACT_FNAME VARCHAR(50) NOT NULL,
			CONTACT_LNAME VARCHAR (50) NOT NULL,
			CONTACT_EMAIL VARCHAR (100) NOT NULL,
			CONTACT_PHONE VARCHAR (15) NOT NULL,
			NUMBER_OF_PEOPLE INT (3) NOT NULL,
			DATE_OF_ORDER DATE NOT NULL,
			TIME_OF_ORDER TIME NOT NULL,
			DATE_OF_MEAL DATE NOT NULL,
			AMOUNT_PER_HEAD DOUBLE NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			CLEARED ENUM('0','1'),
			DATE_CLEARED DATETIME NOT NULL,
			TID VARCHAR(10) UNIQUE KEY NOT NULL,
			CONFIRMATION_ID VARCHAR(25) UNIQUE KEY NOT NULL

		)";
		Database::$connection->exec($sql);//Execute the query

		$sql="CREATE TABLE IF NOT EXISTS SPECIAL_ORDERS_MEALS(
		ID INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		SPECIAL_ORDER_ID INT (11) NOT NULL,
		MEAL_NAME ENUM('BREAKFAST','LUNCH','SUPPER'),
		FOREIGN KEY (SPECIAL_ORDER_ID) REFERENCES SPECIAL_ORDERS(ID)
		)";
		Database::$connection->exec($sql);//Execute the query

		$sql = "CREATE TABLE IF NOT EXISTS SALES_ITEMS(

		ID INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		ITEM_NAME VARCHAR (100) NOT NULL UNIQUE KEY,
		UNIT VARCHAR (20) NOT NULL,
		ITEM_QUANTITY INT (5) NOT NULL,
		DIVISION_PER_PLATE DOUBLE NOT NULL,
		PRICE DOUBLE NOT NULL,
		DATE_ADDED DATE NOT NULL,
		TIME_ADDED TIME NOT NULL,
		DATE_LAST_MODIFIED DATE NOT NULL,
		TIME_MOD TIME NOT NULL


		)";

		Database::$connection->exec($sql);//Execute the query
		$sql = "CREATE TABLE IF NOT EXISTS SPECIAL_ORDER_MENU (

			MEAL_ID INT (11) NOT NULL,
			FOOD_ID INT (11) NOT NULL,
			QANTITY_PER_PERSON  INT (2) NOT NULL,
			FOREIGN KEY (MEAL_ID) REFERENCES SPECIAL_ORDERS_MEALS (ID),
			FOREIGN KEY (FOOD_ID) REFERENCES SALES_ITEMS(ID)
			)";

			Database::$connection->exec($sql);//Execute the query

			$sql = "CREATE TABLE IF NOT EXISTS SALES_LOGS(
			RECEIPT_ID INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			CASHIER INT (11) NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			SALES_TYPE ENUM('NORMAL','SPECIAL_ORDER'),
			DATE_OF_SALE DATE NOT NULL,
			TIME_OF_SALE TIME NOT NULL,
			FOREIGN KEY (CASHIER) REFERENCES USERS(ID)
			)";
			Database::$connection->exec($sql);//Execute the query


			$sql = "CREATE TABLE IF NOT EXISTS SOLD_ITEMS (
			RECEIPT_ID INT (11) NOT NULL,
			
			ITEM INT (11) NOT NULL,
			UNITS_SOLD INT (3) NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			FOREIGN KEY(RECEIPT_ID) REFERENCES SALES_LOGS (RECEIPT_ID),
			FOREIGN KEY (ITEM) REFERENCES SALES_ITEMS (ID)
			)";


		Database::$connection->exec($sql);//Execute the query






		$sql = "CREATE TABLE IF NOT EXISTS INGREDIENTS(

		FOOD_ID INT(11) NOT NULL,
		STORE_ITEM INT(11) NOT NULL,
		DIVISION DOUBLE NOT NULL,
		FOREIGN KEY (FOOD_ID) REFERENCES SALES_ITEMS(ID),
		FOREIGN KEY (STORE_ITEM) REFERENCES STORE_ITEMS(ID)
		)";

		Database::$connection->exec($sql);//Execute the query


		$sql = "CREATE TABLE IF NOT EXISTS STORE_LOGS (
		ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		TRUNSACTION ENUM('NEW','ADD','ISSUE','DELETE'),
		TRUNSACTION_DATE DATE NOT NULL,
		TRUNSACTION_TIME TIME NOT NULL
		)";
		Database::$connection->exec($sql);//Execute the query

		$sql="CREATE TABLE IF NOT EXISTS STORE_ITEMS_AFFECTED(
		TRUNSACTION_ID INT(11) NOT NULL,
		ITEM_ID INT(11) NOT NULL,
		ITEM_QUANTITY DOUBLE NOT NULL,
		FOREIGN KEY (ITEM_ID) REFERENCES STORE_ITEMS(ID),
		FOREIGN KEY (TRUNSACTION_ID) REFERENCES STORE_LOGS(ID)

		)";
		Database::$connection->exec($sql);//Execute the query
		Database::$connection = null; //DestroyDatabase:: connection
		$sql=null;
	}
//End Create tables
}

//This method adds to the table specified in the argument data array specified in the argument
public static function add($table, $data_array){

	Database::connect();
	if (Database::$connection != null) {
		$today  =  date("Y-m-d h:i:s");
		$date = explode(" ", $today)[0];
		$time = explode(" ", $today)[1];
		if ($table == 'USERS') {
			$sql="INSERT INTO USERS(FIRST_NAME,LAST_NAME,EMAIL,USERNAME,PASSWORD,USER_TYPE,REGISTER_DATE,REGISTER_TIME) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$data_array[4]','$data_array[5]','$date','$time'
			)";
			Database::$connection->exec($sql);//Execute the query
		Database::$connection = null; //DestroyDatabase:: connection
		$sql=null;
		}else if($table == 'STORE_ITEMS'){

			/*
	ID INT (11) PRIMARY KEY  NOT NULL AUTO_INCREMENT,
			ITEM_NAME  VARCHAR (100) UNIQUE KEY NOT NULL,
			UNIT VARCHAR (20) NOT NULL,
			ITEM_QUANTITY INT(11) NOT NULL,
			UNIT_PRICE FLOAT NOT NULL,

			DATE_ADDED DATE NOT NULL,
			TIME_ADDED TIME NOT NULL,

			DATE_LAST_MODIFIED DATE NOT NULL,
			TIME_MOD TIME NOT NULL

			*/
			$sql="INSERT INTO STORE_ITEMS(ITEM_NAME,UNIT,ITEM_QUANTITY,UNIT_PRICE,DATE_ADDED,TIME_ADDED, DATE_LAST_MODIFIED,TIME_MOD) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$date','$time','$date','$time'
			)";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;
			Database::add('STORE_ITEMS_AFFECTED',array(Database::add('STORE_LOGS', array('NEW')),$id,$data_array[2]));




			}else if ($table =='SPECIAL_ORDERS' ) {

				/*
		ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			GROUP_NAME VARCHAR(100) NOT NULL,
			CONTACT_FNAME VARCHAR(50) NOT NULL,
			CONTACT_LNAME VARCHAR (50) NOT NULL,
			CONTACT_EMAIL VARCHAR (100) NOT NULL,
			CONTACT_PHONE VARCHAR (15) NOT NULL,
			NUMBER_OF_PEOPLE INT (3) NOT NULL,
			DATE_OF_ORDER DATE NOT NULL,
			TIME_OF_ORDER TIME NOT NULL,
			DATE_OF_MEAL DATE NOT NULL,
			AMOUNT_PER_HEAD DOUBLE NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			CLEARED ENUM('0','1')


				*/
			$sql="INSERT INTO SPECIAL_ORDERS(GROUP_NAME,CONTACT_FNAME,CONTACT_LNAME,CONTACT_EMAIL,CONTACT_PHONE,NUMBER_OF_PEOPLE,DATE_OF_ORDER,TIME_OF_ORDER,DATE_OF_MEAL,AMOUNT_PER_HEAD,TOTAL_AMOUNT,CLEARED,TID,CONFIRMATION_ID) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$data_array[4]','$data_array[5]','$date','$time','$data_array[6]','$data_array[7]','$data_array[8]',0,'$data_array[9]','$data_array[10]'
			)";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

				//Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;

			return $id;


		}else if($table == 'SPECIAL_ORDERS_MEALS'){
				$sql="INSERT INTO SPECIAL_ORDERS_MEALS(SPECIAL_ORDER_ID,MEAL_NAME) VALUES (
			'$data_array[0]','$data_array[1]'
			)";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

				//Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;

				return $id;
		}else if ($table == 'SALES_ITEMS') {


			/*
ID INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		ITEM_NAME VARCHAR (100) NOT NULL UNIQUE KEY,
		UNIT VARCHAR (20) NOT NULL,
		ITEM_QUANTITY INT (5) NOT NULL,
		DIVISION_PER_PLATE DOUBLE NOT NULL,
		PRICE DOUBLE NOT NULL,
		DATE_ADDED DATE NOT NULL,
		TIME_ADDED TIME NOT NULL,
		DATE_LAST_MODIFIED DATE NOT NULL,
		TIME_MOD TIME NOT NULL
			*/
				$sql="INSERT INTO SALES_ITEMS(ITEM_NAME,UNIT,ITEM_QUANTITY,DIVISION_PER_PLATE,PRICE,DATE_ADDED,TIME_ADDED,DATE_LAST_MODIFIED,TIME_MOD) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$data_array[4]','$date','$time','$date','$time'
			)";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

				//Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;

				return $id;

			/*

			$sql = "CREATE TABLE IF NOT EXISTS SPECIAL_ORDER_MENU (

			MEAL_ID INT (11) NOT NULL,
			FOOD_ID INT (11) NOT NULL,
			QANTITY_PER_PERSON  INT (2) NOT NULL,
			FOREIGN KEY (MEAL_ID) REFERENCES SPECIAL_ORDERS_MEALS (ID),
			FOREIGN KEY (FOOD_ID) RECORD_NAME SALES_ITEMS(ID)
			)";*/

		}else if ($table == 'SPECIAL_ORDER_MENU') {
				$sql="INSERT INTO SPECIAL_ORDER_MENU(MEAL_ID,FOOD_ID,QANTITY_PER_PERSON) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]'
			)";
Database::$connection->exec($sql);//Execute the query
		Database::$connection = null; //DestroyDatabase:: connection
		$sql=null;

/*
	$sql = "CREATE TABLE IF NOT EXISTS SALES_LOGS(
			RECEIPT_ID INT (11) PRIMARY KEY NOT NULL,
			CASHIER INT (11) NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			DATE_OF_SALE DATETIME NOT NULL,
			FOREIGN KEY (CASHIER) REFERENCES USERS(ID)
			)";
*/
		}else if ($table == 'SALES_LOGS') {

			/*
RECEIPT_ID INT (11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			CASHIER INT (11) NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			SALES_TYPE ENUM('NORMAL','SPECIAL_ORDER'),
			DATE_OF_SALE DATE NOT NULL,
			TIME_OF_SALE TIME NOT NULL,
			FOREIGN KEY (CASHIER) REFERENCES USERS(ID)

			*/
			$sql="INSERT INTO `sales_logs`( `CASHIER`, `TOTAL_AMOUNT`, `SALES_TYPE`, `DATE_OF_SALE`,`TIME_OF_SALE`) VALUES ('$data_array[0]','$data_array[1]','$data_array[2]','$date','$time')";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

				//Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;

			return $id;

/*
$sql = "CREATE TABLE IF NOT EXISTS SOLD_ITEMS (
			RECEIPT_ID INT (11) NOT NULL,
			SALES_TYPE ENUM('NORMAL','SPECIAL_ORDER'),
			ITEM INT (11) NOT NULL,
			UNITS_SOLD INT (3) NOT NULL,
			TOTAL_AMOUNT DOUBLE NOT NULL,
			FOREIGN KEY(RECEIPT_ID) REFERENCES SALES_LOGS (RECEIPT_ID),
			FOREIGN KEY (ITEM) REFERENCES SOLD_ITEMS (ID)
			)";
*/
		}else if ($table == 'SOLD_ITEMS') {
					$sql="INSERT INTO SOLD_ITEMS(RECEIPT_ID,ITEM,UNITS_SOLD,TOTAL_AMOUNT) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]'
			)";
		Database::$connection->exec($sql);//Execute the query
		Database::$connection = null; //DestroyDatabase:: connection
		$sql=null;
			/*
$sql = "CREATE TABLE IF NOT EXISTS STORE_LOGS(

				ID INT(11) PRIMARY KEY NOT NULL,
				ITEM INT(11) FOREIGN KEY REFERENCES STORE_ITEMS(ID),
				TRUNSACTION ENUM('ADD','ISSUE','DELETE'),
				UNITS INT (3) ,
				TRUNSACTION_DATE DATETIME NOT NULL

			 	)";
			*/
		}else if ($table == 'INGREDIENTS') {
				$sql="INSERT INTO INGREDIENTS(FOOD_ID,STORE_ITEM,DIVISION) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]'
			)";
			Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;
		}else if ($table == 'STORE_LOGS') {

			/*
TRUNSACTION ENUM('NEW','ADD','ISSUE','DELETE'),
		TRUNSACTION_DATE DATE NOT NULL,
		TRUNSACTION_TIME TIME NOT NULL,
			*/
			$sql ="INSERT INTO `store_logs`(`TRUNSACTION`, `TRUNSACTION_DATE`,`TRUNSACTION_TIME`) VALUES ('$data_array[0]','$date','$time')";
			$stmt=Database::$connection->prepare($sql);
			$stmt->execute();
			$id = Database::$connection->lastInsertId();

				//Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;

			return $id;
		}else if ($table == 'STORE_ITEMS_AFFECTED') {
			$sql ="INSERT INTO `store_items_affected`(`TRUNSACTION_ID`, `ITEM_ID`, `ITEM_QUANTITY`) VALUES ('$data_array[0]','$data_array[1]','$data_array[2]')";
			Database::$connection->exec($sql);//Execute the query
			Database::$connection = null; //DestroyDatabase:: connection
			$sql=null;
		}

		
	

//End add()
}
}

//RETURNS ALL DATA FROM A TABLE
public static function getAll($table){
	Database::connect();
	if (Database::$connection != null) {	
    $stmt = Database::$connection->prepare("SELECT * FROM $table"); 
    $stmt->execute();


  return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


/*
*This function is used to update the table given in the argument.
*@param table  is the table to update
*@param attr is the attribute we want to update
*@param  new is the new value we want for the attribute
*@param pk The value in the primary key
*/
//update('SPECIAL_ORDERS', 'CONFIRMATION_ID', $this->confirmationCode, $this->id);
public static  function update($table, $attr, $new, $pk){
	Database::connect();
	if (Database::$connection != null) {
		$today  =  date("Y-m-d h:i:s");
		$sql= "UPDATE $table SET $attr = '$new' WHERE ID = '$pk'";



		Database::$connection->exec($sql);//Execute the query

		try {
		$sql= "UPDATE $table SET DATE_LAST_MODIFIED = '$today' WHERE ID = '$pk'";
		Database::$connection->exec($sql);//Execute the query
		$sql=null;
			    }
			catch(PDOException $e)
			    {
			    return null;
			    }


			    	 try {

		$sql= "UPDATE $table SET DATE_CLEARED = '$today' WHERE ID = '$pk'";
		Database::$connection->exec($sql);//Execute the query
		$sql=null;
			    }
			catch(PDOException $e)
			    {
			    return null;
			    }
	}
}

//Deleting record from the Database

public static function delete($table, $pk){
	Database::connect();
	if (Database::$connection != null) {	
		$sql= "DELETE FROM $table  WHERE ID = '$pk'";
		Database::$connection->exec($sql);//Execute the query
		Database::$connection = null; //DestroyDatabase:: connection
		$sql=null;
	}
}

public static function record_exist($table,$unique_key,$unique_key_value){
	Database::connect();
	if (Database::$connection != null) {
		$stmt = Database::$connection->prepare("SELECT * FROM $table WHERE $unique_key = '$unique_key_value'"); 
		$stmt->execute(); 
		if ($row = $stmt->fetch()) {
			return true;
		}else{
			return false;
		}
	}
}

//End of Class
}
 Database::create_db();
 Database::createTables();
//print_r(Database::getAll('USERS'));echo "<br>";
//print_r(Database::getAll('RECORDS'));echo "<br>";
//print_r(Database::getAll('ORDERS'));echo "<br>";

//echo $date = date('m/d/Y h:i:s a', time());;

 //Database::update('USERS', 'USERNAME', 'kimmiejoe', 1);

 ?>