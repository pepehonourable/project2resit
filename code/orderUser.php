<?php
    include "header.php";
    include "connect.php";
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
                    $sql = "SELECT l.OrderId, group_concat(' ',p.Title, ' (',l.Quantity,')') as Titles, o.Delivered FROM orders o, product p, orderLine l WHERE l.ProductId=p.ProductId AND l.OrderId=o.OrderId AND o.UserId=1 GROUP BY OrderId ORDER BY OrderId DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result))
                        if($row['Delivered'] == "No"){
                            echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s): " .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "<button></button></li>";
                        } else {
                          echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s): " .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "</li>";
                        }
                      } else {
                        echo "0 results";
                      }
                ?>
            </div>
        </div>
    </body>
</html>