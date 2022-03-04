<?php
session_start();
require "connect.php";
$product = $_GET['id'];

$cookieArray = json_decode($_COOKIE['cart'], true);
unset($cookieArray[$product]);
setcookie("cart", json_encode($cookieArray), time() + (86400 * 365));
header('location:cart.php');
?>