<?php
include "header.php";
include "connect.php";
session_start();
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
        <form name="sort" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <?php

        $stmt = $conn->prepare("SELECT Title FROM Product");
		$stmt->execute();
        
        $result = $stmt->get_result();

        echo '<select name="productName" id=productName>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option>' . $row['Title'] . '</option>' .$productId=$row['Title'];
        }
        echo '</select>';
        
        ?>
        </form>
        <?php
        $stmt=$conn->prepare("SELECT f.text, f.image, f.rating, u.userName FROM feedback f, user u WHERE f.productId=?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        $result = $stmt->get_result();
        $num_of_rows = $result->num_rows;

        while ($row = $result->fetch_assoc()) {
            echo 'Username: ' .$row['userName']. '<br>';
            echo 'Feedback: ' .$row['text']. '<br>';
            echo 'Image:<br><img src="../userUpload/' .$row['image']. '" style=max-height:300px;><br>';
            echo 'Rating: ' .$row['rating']. ' out of 5<br>';
            echo "<hr>";
        } ?>
        </form>
    </div>
</body>
