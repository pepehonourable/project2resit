<?php
session_start();
require "connect.php";
$product = $_GET['id'];

/*
$product = $_SESSION['Product'];
$table = $_SESSION['Table'];
$field = $_SESSION['Field'];
mysqli_query($conn,"DELETE FROM $table WHERE UserId=1 AND '$field=$product'");
header('location:cart.php');*/

foreach($_SESSION['cart'] as $k => $v) {
    if($v == $product)
      unset($_SESSION['cart'][$k]);
  }

header('location:cart.php');
?>