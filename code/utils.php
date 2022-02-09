<?php
    require "connect.php";
        function order(){
            global $conn;

            $sql = "SELECT l.OrderId, group_concat(' ',p.Title, ' (',l.Quantity,')') as Titles, o.Delivered FROM orders o, product p, orderLine l WHERE l.ProductId=p.ProductId AND l.OrderId=o.OrderId AND o.UserId=1 GROUP BY OrderId ORDER BY OrderId DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result))
                        if($row['Delivered'] == "No"){
                            echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s):" .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "     <button></button></li>";
                        } else {
                          echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s):" .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "</li>";
                        }
                      } else {
                        echo "0 results";
                      }
                    }
                      ?>