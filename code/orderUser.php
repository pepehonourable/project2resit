<?php
    include "header.php";
    include "connect.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Orders</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
    </head>
    <body>
        <div class="content">
            <h1>Orders</h1>
            <div class="orders">
                <?php
                    $sql = "SELECT o.OrderId, p.Title, o.Delivered FROM orders o, product p WHERE o.ProductId=p.ProductId AND o.UserId=1";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result))
                        if($row['Delivered'] == "No"){
                            echo "<li>Order id: " . $row["OrderId"] . "<br> Album(s): " . $row["Title"] . "<br> Delivered: ". $row["Delivered"]. "<button></button> </li>";
                        } else {
                          echo "<li>Order id: " . $row["OrderId"] . "<br> Album(s): " . $row["Title"] . "<br> Delivered: ". $row["Delivered"]. "</li>";
                        }
                      } else {
                        echo "0 results";
                      }
                ?>
            </div>
        </div>
    </body>
</html>
