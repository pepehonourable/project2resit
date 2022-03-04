<?php
session_start();
require "connect.php";
$id = $_GET['id'];
//check if product is already in the cart

$cookieArray = json_decode($_COOKIE['cart'],true);

if (isset($_SESSION['userId'])) {
	if (!isset($_COOKIE['cart'])) {
		$cart = [$_GET['id'] => '1'];
		setcookie("cart", json_encode($cart), time() + (86400 * 365));
	} else if (
		!array_key_exists($_GET['id'], $cookieArray)) {
		$temparray = [$_GET['id'] => '1'];
		$cart = array_replace_recursive($cookieArray, $temparray);
		setcookie("cart", json_encode($cart), time() + (86400 * 365));
		$_SESSION['message'] = 'Product added to cart';
	} else {
		$_SESSION['message'] = 'Product already in cart';
	}
} else {
	$_SESSION['message'] = 'Please login to add items to cart';
}

header('location: main.php');

?>