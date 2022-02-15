<?php
session_start();
require "connect.php";
$order = $_SESSION['Order'];

mysqli_query($conn,"DELETE FROM orders WHERE UserId=1 AND OrderId=$order");
header('location:orderUser.php');
?>