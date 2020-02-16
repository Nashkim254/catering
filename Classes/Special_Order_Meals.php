<?php 

/**
 * 
 */

include_once 'Database.php';
include_once 'Special_Order_Item.php';
class Special_Order_Meal 
{
	private  $meal_name;
	private $foods = array();//Array of special order items
	private $total;

	private $id;

	function __construct($meal_name,$foods)
	{
		$this->meal_name = $meal_name;
		$this->foods = $foods;

		$this->total = 0.0;
		foreach ($this->foods as $food) {
		$this->total += $food->get_total();
		}

		/*
			$sql="INSERT INTO SPECIAL_ORDERS_MEALS(SPECIAL_ORDER_ID,MEAL_NAME) VALUES (
			'$data_array[0]','$data_array[1]'
			)";
		*/
			
	}

public function get_foods(){
	return $this->foods;
}

public function get_total(){
	return $this->total;
}


public function add($special_order_id){
	$this->id = Database::add('SPECIAL_ORDERS_MEALS',array($special_order_id,$this->meal_name));
		foreach ($this->foods as $food) {
			$food->add($this->id);
		}
}

}
 ?>