<?php
    include "header.php";
    include "connect.php";

    session_start();
    //$_SESSION['Table'] = basename(__FILE__, '.php');
    $_SESSION['Table'] = "cart";

if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
 
	//unset quantity
	unset($_SESSION['quantity']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cart</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
    </head>
    <body>
        <div class="content">
        <?php 
			if(isset($_SESSION['message'])){
				?>
				<div>
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php
				unset($_SESSION['message']);
			}
			?>
            <form action="cartSave.php" method="POST">
                <table>
                    <th>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Unit Price €</th>
                            <th>Quantity</th>
                            <th>Sub Total €</th>
                            <th>Remove Item</th>
                        </tr>
                    </th>
                    <?php
                    $totalPrice = 0;
                    $index = 0;
                    if(!empty($_SESSION['cart'])){
                    //create array of initail qty which is 1
                    if(!isset($_SESSION['quantity'])){
                        $_SESSION['quantity'] = array_fill(0, count($_SESSION['cart']), 1);
                     }
                    $sql = "SELECT * FROM product WHERE ProductId IN (".implode(',',$_SESSION['cart']).")";
                    $query = $conn->query($sql);
                        while($row = $query->fetch_assoc()){
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row["Title"];?></td>
                                <td><?php echo $row["Price"];?></td>
                                <td><input type="number" min="1" value="<?php echo $_SESSION['quantity'][$index]; ?>" name="quantity<?php echo $index; ?>"></td>
                                <td><?php $subTotal = $_SESSION['quantity'][$index]*$row['Price']; echo $subTotal ?></td>
                                <td><a href='delete.php?id=<?php echo $row['ProductId']?>'>Delete product</a></td>
                            </tr>
                                <?php
                                $index ++;
                                $totalPrice += ($subTotal);
                            }
                            var_dump($_SESSION['quantity']);
                            echo "Total Price: €" . $totalPrice; 
						}
						else{
							?>
							<tr>
								<td>No Items in Cart</td>
							</tr>
							<?php
						}                       			
                    ?>
                </table>
                <button type="submit" name="empty">Empty cart</button>
                <button type="submit" name="save">Save changes</button>
                <button type="submit" name="order">Order Items</button>
            </form>
        </div>
    </body>
</html>