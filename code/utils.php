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

<?php

/*require "connect.php";
function cart(){
    global $conn;

$id=1;

$sql = "SELECT c.UserId, c.ProductId, c.Quantity, p.Title, p.Price FROM cart c, product p, user u WHERE c.UserId=u.UserId AND c.ProductId=p.ProductId AND $id=1";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result))
                            echo "<li>" .$row["Title"]. "<br>Amount:".$row["Quantity"]. "<br>Price: " .$row["Price"]. "</li>";
                        } else {
                        echo "No items in cart!";
                      }
                    }
                
                    */

require "connect.php";
function cart(){
global $conn;
                    


$sql = "SELECT c.UserId, c.ProductId, p.Title, p.Price, c.Quantity FROM cart c, product p, user u WHERE c.UserId=u.UserId AND c.ProductId=p.ProductId AND c.UserId=1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
       
        ?>
        <tr>
            <td> </td>
            <td><?php echo $row["Title"]; ?></td>
            <td><?php echo $row["Price"]; ?></td>
            <td><input type="number" class="" value="<?php echo $row["Quantity"]; ?>" > </td>
            <td><?php $cost=$row["Price"]*$row["Quantity"]; echo $cost?></td>
        </tr>
            <?php
        } 
        
    }}
?>