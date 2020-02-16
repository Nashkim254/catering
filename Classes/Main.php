<?php
include_once 'Database.php';
include_once 'User.php';
include_once 'Sold.php';
include_once 'Sale.php';
include_once 'Store_Item.php';
include_once 'Sales_Item.php';
include_once 'Ingredient.php';
include_once 'Special_Order_Item.php';
include_once 'Special_Order_Meals.php';
include_once 'Special_Order.php';


//Function to validate data

$order = null;

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//Create Users

function alert($message){
	echo "<script type='text/javascript'>alert('$message');</script>";
	return;
}

function redirect($page){
	echo "<script>setTimeout(\"location.href = '$page';\",5);</script>";
	exit();
}


if(isset($_POST['register'])) {
//($first_name,$last_name,$email,$username, $password,$user_type)
	$first_name = validate_input($_POST['first_name']);
	$last_name = validate_input($_POST['last_name']);
	$username = validate_input($_POST['username']);
	$password = validate_input($_POST['password']);
	$con_password = validate_input($_POST['con_password']);
	$user_type = validate_input($_POST['user_type']);
	$email = validate_input($_POST['email']);



	// return filter_var($email, FILTER_VALIDATE_EMAIL);
	if (strlen($email) == 0 or strlen($first_name) == 0 or  strlen($last_name) == 0 or  strlen($username) == 0 or  strlen($password) == 0 or  strlen($user_type) == 0) {
		echo "All fields required";
		exit();
	}
	//Validate email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email";
		exit();
	}
	if ($password != $con_password) {
		echo "Passwords didn't match";
		exit();
	}

	if (strlen($password) < 3) {
		echo "Password too short";
		exit();
	}


	if (strlen($username) < 3) {
		echo "Username too short";
		exit();
	}


	//Everythis is set
	$user = new User($first_name,$last_name,$email,$username,$password,$user_type);
	echo  $user->add();
	$_POST = array();
	exit();

}



//Login 

if(isset($_POST['login'])) {
	$username_email =validate_input($_POST['username']) ;
	$password = validate_input($_POST['password']);

	if (strlen($username_email)==0) {
		echo "Please enter email or username";
		exit();
	}

	if (strlen($password) ==0) {
		echo "Please enter password";
		exit();
	}

	$result= User::login($username_email, $password);

	if ($result == null) {
		echo  $_SESSION['user_type'];

	}else{
		echo $result;
		exit();
	}
}


//Special Order
if (isset($_POST['new_order'])) {
//($group_name,$contact_fname,$contact_lname,$contact_email,$contact_phone,$number_of_peope,$meals,$date)
	$group_name = validate_input($_POST['group_name']);
	$contact_fname = validate_input($_POST['contact_fname']);
	$contact_lname = validate_input($_POST['contact_lname']);
	$contact_email = validate_input($_POST['contact_email']);
	$contact_phone = validate_input($_POST['contact_phone']);
	$number_of_peope = validate_input($_POST['number_of_peope']);
	$date = validate_input($_POST['date']);

	if (strlen($group_name) == 0 or strlen($contact_fname) == 0 or  strlen($contact_lname) == 0 or  strlen($contact_email) == 0 or  strlen($contact_phone) == 0 or  strlen($number_of_peope) == 0 ) {
		echo "All fields required";
		exit();
	}

if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email";
		exit();
	}

	if (strlen($contact_phone) != 10) {
		echo "Phone is invalid";
		exit();
	}

	$js_meals=$_POST['meals'];
	$meals =[];
	foreach ($js_meals as $js_meal) {
		$meal_name = $js_meal['name'];
		$menu = array();
		foreach ($js_meal['menu'] as $food) {
			array_push($menu, new Special_Order_Item($food['name'],$food['price'],'',$food['id'],$food['quantity']));
			
		}
		array_push($meals, new Special_Order_Meal($meal_name,$menu));
	}

$order = new Special_Order($group_name,$contact_fname,$contact_lname,$contact_email,$contact_phone,$number_of_peope,$meals,$date);
//$total_amount = $order->add();
//echo "ORDER_PLACED .\n Total price for the order is Ksh.".$total_amount." to be payed on the event day";
echo $order->getTotal();
exit();

	
}

//Pay for order
if (isset($_POST['pay_order'])) {

$group_name = validate_input($_POST['group_name']);
	$contact_fname = validate_input($_POST['contact_fname']);
	$contact_lname = validate_input($_POST['contact_lname']);
	$contact_email = validate_input($_POST['contact_email']);
	$contact_phone = validate_input($_POST['contact_phone']);
	$number_of_peope = validate_input($_POST['number_of_peope']);
	$date = validate_input($_POST['date']);

	if (strlen($group_name) == 0 or strlen($contact_fname) == 0 or  strlen($contact_lname) == 0 or  strlen($contact_email) == 0 or  strlen($contact_phone) == 0 or  strlen($number_of_peope) == 0 ) {
		echo "All fields required";
		exit();
	}

if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email";
		exit();
	}

	if (strlen($contact_phone) != 10) {
		echo "Phone is invalid";
		exit();
	}

	$js_meals=$_POST['meals'];
	$meals =[];
	foreach ($js_meals as $js_meal) {
		$meal_name = $js_meal['name'];
		$menu = array();
		foreach ($js_meal['menu'] as $food) {
			array_push($menu, new Special_Order_Item($food['name'],$food['price'],'',$food['id'],$food['quantity']));
			
		}
		array_push($meals, new Special_Order_Meal($meal_name,$menu));
	}

$order = new Special_Order($group_name,$contact_fname,$contact_lname,$contact_email,$contact_phone,$number_of_peope,$meals,$date);
//$total_amount = $order->add();
//echo "ORDER_PLACED .\n Total price for the order is Ksh.".$total_amount." to be payed on the event day";
//echo $order->getTotal();
$order->setTID(validate_input($_POST['tid']));
$conf=$order->add();

echo  "Order placed.\nPayment confirmation code is ".$conf;

exit();
/*

	if (!$order == null) {
	$order->setTID(validate_input($_POST['tid']));
	$order->add();
	echo "Order placed";
	$order = null;
	}else{
		echo "Please fill the order form first";
	}*/

}


//Sale
if (isset($_POST['sale'])) {
	//print_r( $_POST['cat']) ;

	/*PRONE TO ERRORS*/
	$cat= $_POST['cat'];
	$items = array();
	foreach ($cat as $i) {
		$name = $i['name'];
		$quantity = $i['quantity'];
		$id = $i['id'];
		$unit_p = $i['price'];

			$item = new Sold($name, $quantity,'', $unit_p,$id);
			$items= Sold::addToItems($items,$item);
	}

	$sale = new Sale($items,'NORMAL');
	echo $sale->add();
	

	exit();
}


if (isset($_POST['getSalesItems'])) {
	echo json_encode(Database::getAll('SALES_ITEMS'));
	exit();
}


	if (isset($_POST['add_store_item'])) {
		$name = validate_input($_POST['name']);
		$unit = validate_input($_POST['unit']);
		$quantity = validate_input($_POST['quantity']);
		$price = validate_input($_POST['price']);


		if (strlen($name) == 0 or strlen($unit) == 0 or strlen($quantity) == 0 or strlen($price) == 0) {
		alert("Enter all details");
		redirect("../add_store_item.php");
		}

		if (@is_nan($quantity) or $quantity < 1) {
			alert("Please input correct value for quantity");
		redirect("../add_store_item.php");
		}


		if (is_nan($price) or $price < 1) {
			alert("Please input correct value for price");
			redirect("../add_store_item.php");
			exit();
		}
		if (is_numeric($unit)) {
			alert("Units can not be numeric");
			redirect("../add_store_item.php");
			exit();
		}

		$item = new Store_Item($name,$unit,$quantity,$price);
		$item->add();
		alert("Item Added");
		redirect("../add_store_item.php");
	}

//Add sales item 
	if (isset($_POST['get_store_items'])) {
		
		echo json_encode(Database::getAll('STORE_ITEMS'));
	}



	if (isset($_POST['add_sales_item'])) {//add_sales_item
		$js_item = $_POST['item'];
		$ing = $_POST['ingrediets'];

		$ingredients = array();
		$bp =0;
		foreach ($ing as $i) {
			//($food_name,$store_item,$store_item_id,$division)
			array_push($ingredients, new Ingredient($i['food_name'],$i['store_item'],$i['store_item_id'],$i['division']));
			$bp+=$i['price'];
			
		}
		$profit = $js_item['profit'];
		$sp = ((100+$profit)/100)*$bp;
		$sales_item = new Sales_Item($js_item['name'],$js_item['unit'],$js_item['division'],$js_item['quantity'],$sp,$ingredients);
		//echo $sales_item->getPrice();
		$sales_item->add();
		echo "ADDED \nCalculated price is ".$sp;

		exit();
	}

	if (isset($_POST['getIngredients'])) {
	 echo json_encode(Sales_Item::getIngredients($_POST['id']));
	 exit();
	}

if (isset($_POST['issueItems'])) {
	$sales_items = $_POST['items_to_prepare'];
	$store_items = $_POST['store_items'];


	$inadequate = false;

	$tid = Database::add('STORE_LOGS',array('ISSUE'));
	foreach ($store_items as $store_item) {
		$result = Store_Item::update($store_item['id'],'ISSUE',$store_item['quantity'],$tid);

		if ($result == 'NOT_ENOUGH') {
			echo 'Can not issue '.$store_item['quantity'].$store_item['units'].' of '.$store_item['name'].' as there is that much currently in the store'."<br>";
			$inadequate = true;
		}

	}
	//Add the items to prepare list
	foreach ($sales_items as $sales_item) {
		Sales_Item::update($sales_item['id'],'ADD',$sales_item['quantity']);
	}



	if ($inadequate) {
		echo "The rest of the items successfully issued";
		exit();
	}else{
		echo "All items issued successfully";
		exit();
	}
}
if (isset($_POST['getSalesLogs'])) {
echo json_encode(Sale::getSalesLogs());
exit();
}


if (isset($_POST['getSoldItems'])) {
echo json_encode(Sale::getSoldItems($_POST['receipt_id']));
exit();
}

if (isset($_POST['getStoreLogs'])) {
echo json_encode(Store_Item::getLogs());
exit();
}
if (isset($_POST['update_store_quantity'])) {
$tid = Database::add('STORE_LOGS',array('ADD'));
echo  Store_Item::update($_POST['id'],'ADD',$_POST['quantity'],$tid);
exit();
}

if (isset($_POST['getTransactionDetails'])) {
	echo  json_encode(Store_Item::getTransactionDetails($_POST['id']));
	exit();
}
if (isset($_POST['getOrders'])) {
	echo json_encode(Special_Order::getSpecialOrders());
	exit();
}

if (isset($_GET['clear_order'])) {
	if ($_GET['clear_order'] == 'set') {
		if (isset($_GET['id'])) {
			$msg= Special_Order::clear($_GET['id']);
			alert($msg);
			redirect("../special.php");
			//header("Location: ../special.php");
		}else{/*redirect*/}
	}else{/*redirect*/}
}

if (isset($_POST['getMeals'])) {
	echo json_encode(Special_Order::getMeals($_POST['id']));
	exit();
}
if (isset($_POST['getMealMenu'])) {
	echo json_encode(Special_Order::getSoldPerMeal($_POST['id']));
	exit();
}
if (isset($_POST['getUsers'])) {
	echo  json_encode(Database::getAll('USERS'));
	exit();
}

?>