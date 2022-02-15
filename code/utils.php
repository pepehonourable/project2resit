<?php
    require "connect.php";
        function order(){
            global $conn;

            $sql = "SELECT l.OrderId, group_concat(' ',p.Title, ' (',l.Quantity,')') as Titles, o.Delivered FROM orders o, product p, orderLine l WHERE l.ProductId=p.ProductId AND l.OrderId=o.OrderId AND o.UserId=1 GROUP BY OrderId ORDER BY OrderId DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result))
                        if($row['Delivered'] == "No"){
                            $_SESSION['Order'] = $row["OrderId"];
                            echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s):" .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "<br><a href='deleteOrder.php'>Delete order</a></li>";
                        } else {
                          echo "<li>Order id: " .$row["OrderId"]. "<br> Album(s):" .$row["Titles"]. "<br> Delivered: " .$row["Delivered"]. "</li>";
                        }
                      } else {
                        echo "0 results";
                      }
                    }
                    ?>

<?php

require "connect.php";
function cart(){
global $conn;

$totalPrice = 0;

$sql = "SELECT c.UserId, c.ProductId, p.Title, p.Price, c.Quantity FROM cart c, product p, user u WHERE c.UserId=u.UserId AND c.ProductId=p.ProductId AND c.UserId=1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td> </td>
            <td><?php echo $row["Title"]; $_SESSION['Product'] = $row["ProductId"]; ?></td>
            <td><?php echo $row["Price"]; ?></td>
            <td><input type="number" class="" value="<?php echo $row["Quantity"]; ?>" > </td>
            <td><?php $cost = $row["Price"]*$row["Quantity"]; $_POST['$totalPrice'] = 3; echo "€" .$cost?></td>
            <td><a href="delete.php">Delete product</a></td>
        </tr>
            <?php
            $totalPrice += ($cost);
        }
        echo "Total Price: €" . $totalPrice; 
    }
}
?>
<?php ;
/*
require "connect.php";
function delete(){
global $conn;

$product = $_SESSION['Product'];
mysqli_query($conn,"DELETE FROM cart WHERE UserId=1 AND ProductId=$product");
$product = 0;
}
*/
?>