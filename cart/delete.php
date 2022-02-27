<?php
session_start();
require "connect.php";
$product = $_SESSION['Product'];
/*
$product = $_SESSION['Product'];
$table = $_SESSION['Table'];
$field = $_SESSION['Field'];
mysqli_query($conn,"DELETE FROM $table WHERE UserId=1 AND '$field=$product'");
header('location:cart.php');*/

mysqli_query($conn,"DELETE FROM cart WHERE UserId=1 AND ProductId=$product");
header('location:cart.php');
?>
