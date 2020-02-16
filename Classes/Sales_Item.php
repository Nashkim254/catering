<?php
/**
 * 
 */
include_once 'Database.php';
class Sales_Item
{

	private $ITEM_NAME;
	private $UNIT;
	private $DIVISION_PER_PLATE;
	private $price;
	private $quantity;
	private $ingredients = array();
	private $id ;
	function __construct($name, $unit,$div,$qtty,$price, $ingredients)
	{
		$this->ITEM_NAME = $name;
		$this->UNIT = $unit;
		$this->DIVISION_PER_PLATE = $div;
		$this->quantity = $qtty;
		$this->price = $price;
		$this->ingredients = $ingredients;
		 // try {

   $this->id = Database::add('SALES_ITEMS',array($this->ITEM_NAME,$this->UNIT,$this->quantity,$this->DIVISION_PER_PLATE,$this->price));

      //     }
      // catch(PDOException $e)
      //     {
      //    echo "Record already added!";
      //    exit();
      //     }
		
	}


		public function getName(){
			return $this->ITEM_NAME;
		}


		public function getUnit(){
			return $this->UNIT;
		}



		public function getDivPerPlate(){
			return $this->DIVISION_PER_PLATE;
		}

		public function getPrice(){
			return $this->price;
		}


		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

	public function add(){
		foreach ($this->ingredients as $ingredient) {
			$ingredient->add($this->id);
		}

	}

	public static function getIngredients($id)
	{
		$sql = "SELECT ingredients.STORE_ITEM as id, ingredients.DIVISION as division, store_items.ITEM_NAME as name, store_items.UNIT as units from ingredients INNER JOIN store_items on ingredients.STORE_ITEM = store_items.ID WHERE food_id = '$id'";
		//SELECT ingredients.STORE_ITEM as id, ingredients.DIVISION as division, store_items.ITEM_NAME as name, store_items.UNIT as units from ingredients WHERE food_id = 1 INNER JOIN store_items on ingredients.STORE_ITEM=store_items.ID;


		//SELECT ingredients.STORE_ITEM as id, ingredients.DIVISION as division, store_items.ITEM_NAME as name, store_items.UNIT as units from ingredients INNER JOIN store_items on ingredients.STORE_ITEM = store_items.ID
		$connection = Database::connect();
		if ($connection  != null) {
		 $stmt = $connection->prepare($sql); 
   		 $stmt->execute();

  		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public static function update($id,$action,$quantity)
	{
		$conncetion = Database::connect();
		if($conncetion != null){
		$stmt = $conncetion->prepare("SELECT * FROM SALES_ITEMS WHERE ID = '$id'"); 
		$stmt->execute(); 
		$row = $stmt->fetch();
		$current = $row['ITEM_QUANTITY'];


		if ($action == 'SELL') {
			$new = $current - $quantity;
			if ($current < $quantity) {
				$connection = null; //DestroyDatabase:: connection
				$stmt=null;
				return 'NOT_ENOUGH';
			}else{
			$new = $current - $quantity;
				Database::update('SALES_ITEMS', 'ITEM_QUANTITY', $new, $id);
				$connection = null; //DestroyDatabase:: connection
				//Update sales logs

				$stmt=null;
				return 'SOLD';
			}
		}else if($action == 'ADD'){
			$new = $current + $quantity;
			Database::update('SALES_ITEMS', 'ITEM_QUANTITY', $new, $id);
			$connection = null; //DestroyDatabase:: connection
			$stmt=null;
			return 'ADDED';
		
	}
}
}
}
/*
$s = new Sales_Item('Chapo','','20',20,10,array());

$s->add();

$s = new Sales_Item('Mandazi','','20',20,5,array());

$s->add();

$s = new Sales_Item('Beans','','20',20,20,array());

$s->add();
*/

//print_r(Sales_Item::getIngredients(14));
?>