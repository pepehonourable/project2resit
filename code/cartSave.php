<?php
session_start();
require "connect.php";

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
    $cartKeys = array_keys($cart);
    $cartId = implode(', ', $cartKeys);
    $cartQuantity = array_values($cart);
    $quantity = implode(', ', $cartQuantity);
	foreach ($cartKeys as $cartKey) {
		if(!is_int($cartKey)){
			die("Not all values are int");
		}
	}
}else{
	$_SESSION['message'] = 'Cart set incorrectly';
	header('location: cart.php');
}


if(isset($_POST['save'])){
	$order=[];
	$order['quantity'] = $_POST['quantity'];
	$orderArray = [];
	array_push($orderArray, $order);
	$str = print_r($orderArray,true);
}
 
if(isset($_POST['empty'])){
        unset($_COOKIE['cart']);
        setcookie('cart','', time() - 3600);
		header('location:cart.php');

}

if(isset($_POST['order'])){
	$userId = $_SESSION['userId']; 	
	if(isset($_SESSION['userId'])){
		$trackCode = 32; //remove from database

		$stmt = $conn->prepare("INSERT INTO orders (TrackCode, userId) VALUES (?, ?)");
		$stmt->bind_param("ii", $trackCode, $userId);
		$stmt->execute();
		$lastinsertedId = $conn->insert_id;
		$stmt->close();

		$stmt = $conn->prepare("SELECT * FROM product WHERE ProductId IN (".implode(', ', $cartKeys).")");
		$stmt->execute();
		$result = $stmt->get_result(); // get the mysqli result
		$stmt->close();

$test = 1;

		while($row = mysqli_fetch_assoc($result)){
			$stmt = $conn->prepare("INSERT INTO orderline (OrderId, ProductId, Quantity) VALUES (?, ?, ?)");
			$stmt->bind_param("iii", $lastinsertedId, $row['ProductId'], $test); //CHNAGE THISFW4OFNVOJWEWNLF
			$stmt->execute();

			unset($_COOKIE['cart']);
			setcookie('cart','', time() - 3600);
			header('location: main.php');
			}
		}
		else
		{
		$_SESSION['message'] = 'Please login';
		//header('location: cart.php');
		}
	}
?>