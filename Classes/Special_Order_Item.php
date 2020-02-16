<?php

/**
 * 
 */
include_once 'Database.php';
class Special_Order_Item
{
	private $price;
	private $unit;
	private $quantity;
	private $name;
	private $total ;
	private $id;
	function __construct($name,$price,$unit,$id,$quantity)
	{
		$this->name = $name;
		$this->price = $price;
		$this->unit = $unit;
		$this->quantity = $quantity;
		$this->total = $this->price*$this->quantity;
		$this->id = $id;//Id from sales Items

	}


	public function get_total(){
		return $this->total;
	}

	public function add($meal_id){
		/*
			$sql="INSERT INTO SPECIAL_ORDER_MENU(MEAL_ID,FOOD_ID,QANTITY_PER_PERSON) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]'
			)";
		*/
			Database::add('SPECIAL_ORDER_MENU',array($meal_id,$this->id,$this->quantity));
	}
}



?>