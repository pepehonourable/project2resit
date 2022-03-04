<?php
include "header.php";
include "connect.php";
session_start();

$_SESSION['userId'] = 1; //REMOVE   

$userId = $_SESSION['userId'];

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Feedback</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
</head>

<body>
    <div class="content">
        <h1>Feedback</h1>
        <h2>What did you think of your purchase? Let us know here!</h2>
        <form name="feedback" action="formUpload.php" method="post" enctype="multipart/form-data">
            <p>Product</p>
            <?php
            /*
            $stmt = $conn->prepare("SELECT p.Title FROM Product p, Feedback f, Orderline l, Orders o WHERE o.OrderId=l.OrderId AND l.ProductId=p.ProductId AND o.UserId = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            if ($result = $stmt->execute()) {
                foreach($stmt as $value => $row){
            echo $row['p.Title'];
        }
    }*/
            $stmt = $conn->prepare("SELECT Title FROM Product");
            $stmt->execute();
            $result = $stmt->get_result();
            echo '<select name="productName" id=productName>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option>' . $row['Title'] . '</option>';
            }
            echo '</select>';
            ?>
            <!--Add from database-->
            </select>
            <p>Details of purchase (Max 500 charecters)</p>
            <textarea name="userFeedback"></textarea>
            <p>Rating (Out of 5)</p>
            <select name="rating" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>
            <p>Upload image here!</p>
            <input type="file" name="uploadedFile" id="file"><br><br>
            <button type="submit" name="submit">Upload feedback!</button>
        </form>
    </div>
</body>
