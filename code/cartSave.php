<?php
session_start();
require "connect.php";

if(isset($_POST['save'])){
	$order=[];
	$order['quantity'] = $_POST['quantity'];
	$orderArray = [];
	array_push($orderArray, $order);
	$str = print_r($orderArray,true);
}
 
if(isset($_POST['empty'])){
	unset($_SESSION['cart']);
	header('location: cart.php');
}

if(isset($_POST['order'])){
	$_SESSION['UserId'] = 1;
	$userId = $_SESSION['UserId'];
	//temporary //make automatic from terry
	if(isset($_SESSION['UserId'])){
		$trackCode = 32; //remove from database

		$stmt = $conn->prepare("INSERT INTO orders (TrackCode, UserId) VALUES (?, ?)");
		$stmt->bind_param("ii", $trackCode, $userId);
		$stmt->execute();
		
		$sql = "SELECT * FROM product WHERE ProductId IN (".implode(',',$_SESSION['cart']).")";
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$stmt = $conn->prepare("INSERT INTO orderline (OrderId, ProductId, Quantity) VALUES (53, ?, ?)");
			$stmt->bind_param("ii", $row['ProductId'], $_SESSION['quantity']);
			$stmt->execute();

			unset($_SESSION['cart']);
			}
		}
		else
		{
		echo "Please login";
		}
	}

//for each

/*
$cart = implode(',', $_SESSION['cart']);

$sql = array(); 
$count=0;
foreach( $cart as $row ) {
    $count++;
    $sql[] = '("'.$row.'", '.$cart[count].')';
}
	mysql_query('INSERT INTO orderline (PrdouctId) VALUES '.implode(',', $sql));
	
*/
/*

		$stmt = $conn->prepare("INSERT INTO orderline (ProductId, Quantity) VALUES (?, ?)");

		foreach($productId as $row => $value){
		$stmt->bind_param("ii", $productId, $quantity);
		$stmt->execute();

		$_SESSION['message'] = 'Order Placed';
		header('location: cart.php');
} 
*/
?>