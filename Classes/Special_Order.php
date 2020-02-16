<?php 
include_once('./Database.php');
include_once './Special_Order_Meals.php';
include_once './Sold.php';
include_once './Sale.php';
/**
 * 
 */
class Special_Order
{
	private $id;
	private $group_name;//name 
	private $contact_fname;//
	private $contact_lname;//
	private $contact_email; 
	private $contact_phone; 
	private $number_of_peope; 
	private $date_of_order; 
	private $amount_per_head; 
	private $total_amount; 
	private $cleared; 
	private $meals = array();
	private $date_of_meal;
	private $tid;
	private $confirmationCode;
	function __construct($group_name,$contact_fname,$contact_lname,$contact_email,$contact_phone,$number_of_peope,$meals,$date)
	{
		$this->group_name = $group_name;
		$this->contact_fname = $contact_fname;
		$this->contact_lname = $contact_lname;
		$this->contact_email = $contact_email;
		$this->contact_phone = $contact_phone;
		$this->number_of_peope = $number_of_peope;
		$this->meals = $meals;
		$this->date_of_order = date('m/d/Y h:i:s');
		$this->cleared = 0;
		$this->date_of_meal = $date;


		$this->total_amount =0.0;


		foreach ($this->meals as $meal) {
			$this->total_amount += $meal->get_total();
		}
		$this->total_amount = $this->total_amount*$this->number_of_peope;

		
	}

	private function setId(){
	$this->id = Database::add('SPECIAL_ORDERS',array($this->group_name,$this->contact_fname,$this->contact_lname,$this->contact_email,$this->contact_phone,$this->number_of_peope,$this->date_of_meal,$this->amount_per_head,$this->total_amount,$this->tid,'N/A'));

	$this->confirmationCode = 'SPO-'.date('YmdGis').'-'.$this->id.'-EUCD';
	
	}

	public function getTotal(){
		return $this->total_amount;
	}
	public function setTID($tid){
		$this->tid = $tid;
	}
	public function add(){
		//echo  $this->;
		$this->setId();
		Database::update('SPECIAL_ORDERS', 'CONFIRMATION_ID', $this->confirmationCode, $this->id);
		
		foreach ($this->meals as $meal) {
			$meal->add($this->id);
		}
		return $this->confirmationCode;
	}
	
	public static function clearSql($id){
		$today  =  date("Y-m-d");
		
		$sql = "SELECT * FROM  SPECIAL_ORDERS WHERE ID ='$id'";
		$conncetion = Database::connect();
		$stmt = $conncetion->prepare($sql);
		$stmt->execute();  
		$row = $stmt->fetch();
		
		$date = $row['DATE_OF_MEAL'];
		if ($date > $today) {
			return false;
		}else{
			return true;
		}

		//$sql = "UPDATE SPECIAL_ORDERS SET CLEARED = 1, DATE_CLEARED = '$today'  WHERE ID = '$id'";
		//$connection->exec($sql);//Execute the query

		//$sql = "UPDATE SPECIAL_ORDERS SET DATE_CLEARED = '$today' WHERE ID = '$id'";
		//DATE_OF_MEAL

	}	
	public static function clear($id){
		if(!Special_Order::clearSql($id)){
			return "Can not clear order before the event date!";
		}else{
		//return;
		$today =   date("Y-m-d h:i:s");

		$sale = new Sale(Special_Order::getSoldItems($id),'SPECIAL_ORDER');
		$sale->add();
		Database::update('SPECIAL_ORDERS', 'CLEARED', 1, $id);
		//Special_Order::clearSql($id);

		return "CLEARED";}
	}
	public static function getSoldPerMeal($meal){
		$sql = "SELECT sales_items.ITEM_NAME as name, sales_items.ID as id, special_order_menu.QANTITY_PER_PERSON as per from special_order_menu INNER JOIN sales_items on sales_items.ID = special_order_menu.FOOD_ID WHERE special_order_menu.MEAL_ID = '$meal'";
		$connection = Database::connect();
		$st = $connection->prepare($sql);
		$st->execute();
		return $st->fetchAll(PDO::FETCH_ASSOC);

	}
	public static function getSoldItems($id){
		$sql = "SELECT sales_items.ITEM_NAME as name, sales_items.ID as id, sales_items.PRICE as price, special_order_menu.QANTITY_PER_PERSON as quantity, special_orders.NUMBER_OF_PEOPLE as people, special_orders.TOTAL_AMOUNT as total FROM special_orders INNER JOIN special_orders_meals on special_orders.ID=special_orders_meals.SPECIAL_ORDER_ID INNER JOIN special_order_menu on special_order_menu.MEAL_ID=special_orders_meals.ID INNER JOIN sales_items on sales_items.ID = special_order_menu.MEAL_ID WHERE special_orders.ID ='$id'";
		$connection = Database::connect();
		$stm = $connection->prepare($sql);
		$stm->execute();
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
		$items = array();
		foreach ($rows as $row) {

			$item = new Sold($row['name'], $row['quantity']*$row['people'],'', $row['price'],$row['id']);
			//print_r($item);
			//function __construct($name, $quantity,$unit, $unit_p,$id)
			//array_push($tems, new Sold($row['name'], $row['quantity']*$row['people'],null, $row['price'],$row['id']));
			$items = Sold::addToItems($items, $item);
		}

		return $items;
	}
	public static function getSpecialOrders(){
		return Database::getAll('SPECIAL_ORDERS');
	}
	public static function getMeals($id){
		$sql = "SELECT special_orders_meals.MEAL_NAME as name, special_orders_meals.ID as id FROM special_orders_meals WHERE special_orders_meals.SPECIAL_ORDER_ID = '$id'";
		$connection = Database::connect();
		$stm = $connection->prepare($sql);
		$stm->execute();
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}
}
//Special_Order::getSoldItems(1);
//echo Special_Order::clear(1);

//Database::update('SPECIAL_ORDERS', 'CONFIRMATION_ID','MK', 1);

 ?>