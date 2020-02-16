<?php
include_once 'Database.php';

/**
 * 
 */
class Ingredient
{

	private $food_id;
	private $food_name;
	private $store_item;
	private $store_item_id;
	private  $division;


	function __construct($food_name,$store_item,$store_item_id,$division)
	{
		
		$this->store_item = $store_item;
		$this->division = $division;
		$this->food_name =  $food_name;
		$this->store_item_id = $store_item_id;

	}


	public function add($food){
		$this->food_id = $food;
		//(FOOD_ID,STORE_ITEM,DIVISION)
		Database::add('INGREDIENTS',array($this->food_id,$this->store_item_id,$this->division));
		
	}
}


?>