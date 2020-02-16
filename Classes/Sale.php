<?php
/**
 * 
 */

include_once 'Database.php';
include_once 'Sold.php';
//include_once 'Sales_Item.php';
//session_start();
class Sale
{
	
	private  $receipt_no = null;
	private $items = array();
	private $datetime ;
	private $total_price;
	private $type;
	private $cashier;
	private $error;
	function __construct($items,$type)
	{

		$this->items = $items;
		$this->type = $type;

		$total = 0.0;   

		foreach ($this->items as $item) {
			$total+=$item->get_total();
		}
		
		$this->total_price = $total;
		$this->cashier = $_SESSION['id'];
		$this->datetime = date("Y-m-d h:i:s");
		//echo  $this->total_price;

/*
		$sql="INSERT INTO SALES_LOGS(CASHIER,SALES_TYPE,TOTAL_AMOUNT,DATE_OF_SALE) VALUES (
			'$data_array[0]','$data_array[1]','$data_array[2]','$today'
			)";
*/

		if ($this->sallable()) {
			$this->receipt_no = Database::add('SALES_LOGS',array($this->cashier,$this->total_price,$this->type));
		}
	}



	public function add(){
		if ($this->receipt_no != null) {
			foreach ($this->items as $item) {
			$item->add($this->receipt_no);
		}
		return 'Sales succesfull!';
		}else{
		return	$this->error;
		}
	}

	private function sallable(){
		$sell = true;
		foreach ($this->items as $item) {
			$id = $item->getId();
			$sql = "SELECT sales_items.ITEM_QUANTITY as quantity from sales_items where sales_items.ID = '$id'";
			$connection = Database::connect();
			$stmt = $connection->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			$qty = $row['quantity'];
			if ($qty  < $item->getQ()) {
				$sell = false;
				$this->error = "Could not sell ".$item->getQ()." of ".$item->getName()." as there are only ".$qty." available. Sale Aborted";
				break;
			}
		}
		return $sell;
	}


	public static function getSoldItems($receipt_no){
		
			$connection = Database::connect();
		if (!$connection == null) {
			$sql = "SELECT sales_items.ITEM_NAME as name, sold_items.UNITS_SOLD as quantity,sales_items.PRICE as price, sold_items.TOTAL_AMOUNT as sub_total from sold_items INNER JOIN sales_items on  sold_items.ITEM = sales_items.ID where sold_items.RECEIPT_ID = '$receipt_no'";
			$stmt = $connection->prepare($sql); 
   			 $stmt->execute();
  			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  			$connection = null;
  			$sql= null;
  			return $rows;
		}

	}

	public static function getSalesLogs(){
		$connection = Database::connect();
		if (!$connection == null) {
			$sql = "SELECT sales_logs.RECEIPT_ID as receipt_no, sales_logs.SALES_TYPE as sales_type, users.FIRST_NAME as fname, users.LAST_NAME as lname,sales_logs.DATE_OF_SALE as s_date,sales_logs.TIME_OF_SALE as s_time, sales_logs.TOTAL_AMOUNT as net_total from sales_logs INNER JOIN users on sales_logs.CASHIER = users.ID ORDER BY sales_logs.DATE_OF_SALE,sales_logs.TIME_OF_SALE";
			$stmt = $connection->prepare($sql); 
   			 $stmt->execute();
  			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  			$connection = null;
  			$sql = null;
  			return $rows;
		}
	}

}



/*$sold1 = new Sold('Chapo',20,'',10.0,1);
$sold2 = new Sold('Mandazi',20,'',10.0,2);
$sold3 = new Sold('Beans',20,'',10.0,3);

$items = array($sold1,$sold2,$sold3);

$sale = new Sale($items,'NORMAL');

//$sale->add();*/



?>