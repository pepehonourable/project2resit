<?php
session_start();
require "connect.php";
$order = $_GET['id'];
$userId = $_SESSION['UserId'];
$_SESSION['UserId'] = 1;//DELETE ME

$stmt = $conn->prepare("DELETE FROM orders WHERE UserId=? AND OrderId = ?");
$stmt->bind_param("ii", $userId, $order);
$stmt->execute();

header('location:orderUser.php');
?>