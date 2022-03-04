<?php
include "header.php";
include "connect.php";

session_start();

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
    $cartKeys = array_keys($cart);
    $cartId = implode(', ', $cartKeys);

    $cartQuantity = array_values($cart);
    $quantity = implode(', ', $cartQuantity);

    print_r($cart);}
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
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
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
                if (isset($_COOKIE['cart'])) {
                    foreach ($cartKeys as $cartKey) {
                        if(!is_int($cartKey)){
                            die("Not all values are int");
                        }
                    }
                    print_r($cartId);
                    $stmt = $conn->prepare("SELECT * FROM Product WHERE ProductId IN (".implode(', ',$cartKeys).")");
                    $stmt->execute();

                    $result = $stmt->get_result(); // get the mysqli result
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row["Title"]; ?></td>
                                <td><?php echo $row["Price"]; ?></td>
                                <td><input type="number" min="1" value="<?php echo $cart[$row["ProductId"]]; ?>" name="quantity<?php echo $row["ProductId"]?>"></td>
                                <td><?php $subTotal = $cart[$row["ProductId"]]* $row['Price'];
                                    echo $subTotal ?></td>
                                <td><a href='delete.php?id=<?php echo $row['ProductId'] ?>'>Delete product</a></td>
                            </tr>
                    <?php
                    $totalPrice += ($subTotal);
                        }
                        echo "Total Price: €" . $totalPrice;
                } else {
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