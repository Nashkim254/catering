<?php 

/**
 * 
 */

include_once 'Database.php';
class Store_Item
{
		private $name;
		private $unit;
		private $quantity;
		private $id;
		private $buying_p;

	
	function __construct($name,$unit,$quantity,$buying_p)
	{
		$this->name = $name;
		$this->unit = $unit;
		$this->quantity = $quantity;
		$this->buying_p = $buying_p;
		
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}


	public function add(){
		/*
		$sql="INSERT INTO STORE_ITEMS(ITEM_NAME,UNIT,ITEM_QUANTITY,UNIT_PRICE,DATE_ADDED,DATE_LAST_MODIFIED) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$today','$today','$today'
			)";

		*/
			Database::add('STORE_ITEMS', array($this->name,$this->unit,$this->quantity,$this->buying_p));


	}


	public static function update($id,$action,$quantity,$tid)
	{
		$conncetion = Database::connect();
		if($conncetion != null){
		$stmt = $conncetion->prepare("SELECT * FROM STORE_ITEMS WHERE ID = '$id'"); 
		$stmt->execute(); 
		$row = $stmt->fetch();
		$current = $row['ITEM_QUANTITY'];


		//Issue
		if ($action == 'ISSUE') {
			if ($current < $quantity) {
				$connection = null; //DestroyDatabase:: connection
				$stmt=null;
				return 'NOT_ENOUGH';
			}else{
			$new = $current - $quantity;
				Database::update('STORE_ITEMS', 'ITEM_QUANTITY', $new, $id);
				$connection = null; //DestroyDatabase:: connection
				$stmt=null;
				//Database::add('STORE_LOGS',array($action));
				Database::add('STORE_ITEMS_AFFECTED',array($tid,$id,$quantity));
				return 'ISSUED';
			}
		}else if ($action == 'ADD') {
			$new = $current + $quantity;
			Database::update('STORE_ITEMS', 'ITEM_QUANTITY', $new, $id);
			$connection = null; //DestroyDatabase:: connection
			$stmt=null;
			//Database::add('STORE_LOGS',array($action));
			Database::add('STORE_ITEMS_AFFECTED',array($tid,$id,$quantity));
			return 'ADDED';
		}
		
		/*
$sql="INSERT INTO SOLD_ITEMS(ITEM,TRUNSACTION,UNITS,TRUNSACTION_DATE) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$today'
			)";
		*/
			
		}


		
	}

	public static function getLogs(){
		return Database::getAll('STORE_LOGS');
	}

	public static function getTransactionDetails($id){
		$connection = Database::connect();
		 $sql = "SELECT store_items.ITEM_NAME as name, store_items_affected.ITEM_QUANTITY as quantity, store_items.UNIT as units from store_items_affected INNER JOIN store_items on store_items_affected.ITEM_ID=store_items.ID WHERE store_items_affected.TRUNSACTION_ID= '$id'";
		 $stmt = $connection->prepare($sql); 
   		 $stmt->execute();
   		 $connection = null;
   		 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   		 //print_r($rows);
  		return $rows;
	}
}
/*
echo Store_Item::update(1,'ISSUE',102);
echo Store_Item::update(1,'ADD',102);



*/

 ?>