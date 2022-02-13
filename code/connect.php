<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, "shop");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = mysqli_prepare($conn, $query) OR DIE ("Preparation Error 1");
            mysqli_stmt_execute($stmt) OR DIE ("Data retrieval error");
            mysqli_stmt_bind_result($stmt, $id, $title, $artist, $videoid);
            mysqli_stmt_store_result($stmt);

?> 
