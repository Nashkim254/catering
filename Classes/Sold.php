<?php
include_once 'Database.php';



/**
 * 
 */
class Sold
{
	private $name;
	private $id;
	private $quantity;
	private $unit;
	private  $unit_price;
	private $total;

	function __construct($name, $quantity,$unit, $unit_p,$id)
	{	
		$this->id = $id;
		$this->name = $name;
		$this->quantity = $quantity;
		$this->name = $name;
		$this->unit = $unit;
		$this->unit_price = $unit_p;
		$this->total = $this->quantity*$this->unit_price;
	}
/*
$sql="INSERT INTO SOLD_ITEMS(RECEIPT_ID,SALES_TYPE,ITEM,UNITS_SOLD,TOTAL_AMOUNT) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$data_array[4]'
			)";
*/



public function add($receipt){
	Database::add('SOLD_ITEMS', array($receipt, $this->id,$this->quantity,$this->total));
	Sales_Item::update($this->id,'SELL',$this->quantity);
}

public function get_total(){
	return $this->total;
}

public function getId(){
	return $this->id;
}
public function getName(){
	return $this->name;
}
public function getQ(){
return $this->quantity;
}
public function updateQuantity($item){
	$this->quantity= $this->quantity+ $item->getQ();
	$this->total = $this->quantity*$this->unit_price;
}

public static function addToItems($arr,$item){
	$found = false;
	foreach ($arr as $i) {
		if ($i->getId() == $item->getId()) {
			$i->updateQuantity($item);
			$item = null;
			$found = true;
			break;
		}
	
	}
		if (!$found) {
			array_push($arr, $item);
		}

		return $arr;
}



}

//$sold = new Sold('Chapo',20,'',10.0,1);
//echo  $sold->to_string();


?>